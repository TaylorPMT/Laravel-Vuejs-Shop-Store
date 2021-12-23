<?php
namespace CMS\Product\Library;



class Shortcode
{
    protected $shortcodesTags = [];
    protected $content = '';

    public function __construct($register, $content, $services)
    {
        $this->shortcodesTags = $register;
        $this->content = $content;
    }

    function convertDataJson( $content, $ignore_html = false ) {
        if ( false === strpos( $content, '[' ) ) {
            return $content;
        }

        if ( empty( $this->shortcodesTags ) || ! is_array( $this->shortcodesTags ) ) {
            return $content;
        }

        // Find all registered tag names in $content.
        preg_match_all( '@\[([^<>&/\[\]\x00-\x20=]++)@', $content, $matches );
        $tagnames = array_intersect( array_keys( $this->shortcodesTags ), $matches[1] );

        if ( empty( $tagnames ) ) {
            return $content;
        }


        $pattern = get_shortcode_regex( $tagnames );
        $content = preg_replace_callback( "/$pattern/", 'do_shortcode_tag', $content );

        // Always restore square braces so we don't break things like <!--[if IE ]>.
        $content = unescape_invalid_shortcodes( $content );

        return $content;
    }

    private function do_shortcodes_in_html_tags( $content, $ignore_html, $tagnames ) {
        // Normalize entities in unfiltered HTML before adding placeholders.
        $trans   = array(
            '&#91;' => '&#091;',
            '&#93;' => '&#093;',
        );
        $content = strtr( $content, $trans );
        $trans   = array(
            '[' => '&#91;',
            ']' => '&#93;',
        );

        $pattern = $this->get_shortcode_regex( $tagnames );
        $textarr = $this->wp_html_split( $content );

        foreach ( $textarr as &$element ) {
            if ( '' === $element || '<' !== $element[0] ) {
                continue;
            }

            $noopen  = false === strpos( $element, '[' );
            $noclose = false === strpos( $element, ']' );
            if ( $noopen || $noclose ) {
                // This element does not contain shortcodes.
                if ( $noopen xor $noclose ) {
                    // Need to encode stray '[' or ']' chars.
                    $element = strtr( $element, $trans );
                }
                continue;
            }

            if ( $ignore_html || '<!--' === substr( $element, 0, 4 ) || '<![CDATA[' === substr( $element, 0, 9 ) ) {
                // Encode all '[' and ']' chars.
                $element = strtr( $element, $trans );
                continue;
            }

            $attributes = $this->wp_kses_attr_parse( $element );
            if ( false === $attributes ) {
                // Some plugins are doing things like [name] <[email]>.
                if ( 1 === preg_match( '%^<\s*\[\[?[^\[\]]+\]%', $element ) ) {
                    $element = preg_replace_callback( "/$pattern/", 'do_shortcode_tag', $element );
                }

                // Looks like we found some crazy unfiltered HTML. Skipping it for sanity.
                $element = strtr( $element, $trans );
                continue;
            }

            // Get element name.
            $front   = array_shift( $attributes );
            $back    = array_pop( $attributes );
            $matches = array();
            preg_match( '%[a-zA-Z0-9]+%', $front, $matches );
            $elname = $matches[0];

            // Look for shortcodes in each attribute separately.
            foreach ( $attributes as &$attr ) {
                $open  = strpos( $attr, '[' );
                $close = strpos( $attr, ']' );
                if ( false === $open || false === $close ) {
                    continue; // Go to next attribute. Square braces will be escaped at end of loop.
                }
                $double = strpos( $attr, '"' );
                $single = strpos( $attr, "'" );
                if ( ( false === $single || $open < $single ) && ( false === $double || $open < $double ) ) {
                    /*
                     * $attr like '[shortcode]' or 'name = [shortcode]' implies unfiltered_html.
                     * In this specific situation we assume KSES did not run because the input
                     * was written by an administrator, so we should avoid changing the output
                     * and we do not need to run KSES here.
                     */
                    $attr = preg_replace_callback( "/$pattern/", 'do_shortcode_tag', $attr );
                } else {
                    // $attr like 'name = "[shortcode]"' or "name = '[shortcode]'".
                    // We do not know if $content was unfiltered. Assume KSES ran before shortcodes.
                    $count    = 0;
                    $new_attr = preg_replace_callback( "/$pattern/", 'do_shortcode_tag', $attr, -1, $count );
                    if ( $count > 0 ) {
                        // Sanitize the shortcode output using KSES.
                        $new_attr = $this->wp_kses_one_attr( $new_attr, $elname );
                        if ( '' !== trim( $new_attr ) ) {
                            // The shortcode is safe to use now.
                            $attr = $new_attr;
                        }
                    }
                }
            }
            $element = $front . implode( '', $attributes ) . $back;

            // Now encode any remaining '[' or ']' chars.
            $element = strtr( $element, $trans );
        }

        $content = implode( '', $textarr );

        return $content;
    }

    public function get_shortcode_regex( $tagnames = null ) {
        global $shortcode_tags;

        if ( empty( $tagnames ) ) {
            $tagnames = array_keys( $shortcode_tags );
        }
        $tagregexp = implode( '|', array_map( 'preg_quote', $tagnames ) );

        // WARNING! Do not change this regex without changing do_shortcode_tag() and strip_shortcode_tag().
        // Also, see shortcode_unautop() and shortcode.js.

        // phpcs:disable Squiz.Strings.ConcatenationSpacing.PaddingFound -- don't remove regex indentation
        return '\\['                             // Opening bracket.
            . '(\\[?)'                           // 1: Optional second opening bracket for escaping shortcodes: [[tag]].
            . "($tagregexp)"                     // 2: Shortcode name.
            . '(?![\\w-])'                       // Not followed by word character or hyphen.
            . '('                                // 3: Unroll the loop: Inside the opening shortcode tag.
            .     '[^\\]\\/]*'                   // Not a closing bracket or forward slash.
            .     '(?:'
            .         '\\/(?!\\])'               // A forward slash not followed by a closing bracket.
            .         '[^\\]\\/]*'               // Not a closing bracket or forward slash.
            .     ')*?'
            . ')'
            . '(?:'
            .     '(\\/)'                        // 4: Self closing tag...
            .     '\\]'                          // ...and closing bracket.
            . '|'
            .     '\\]'                          // Closing bracket.
            .     '(?:'
            .         '('                        // 5: Unroll the loop: Optionally, anything between the opening and closing shortcode tags.
            .             '[^\\[]*+'             // Not an opening bracket.
            .             '(?:'
            .                 '\\[(?!\\/\\2\\])' // An opening bracket not followed by the closing shortcode tag.
            .                 '[^\\[]*+'         // Not an opening bracket.
            .             ')*+'
            .         ')'
            .         '\\[\\/\\2\\]'             // Closing shortcode tag.
            .     ')?'
            . ')'
            . '(\\]?)';                          // 6: Optional second closing brocket for escaping shortcodes: [[tag]].
        // phpcs:enable
    }

    public function unescape_invalid_shortcodes( $content ) {
        // Clean up entire string, avoids re-parsing HTML.
        $trans = array(
            '&#91;' => '[',
            '&#93;' => ']',
        );

        $content = strtr( $content, $trans );

        return $content;
    }

    public function wp_html_split( $input ) {
        return preg_split( $this->get_html_split_regex(), $input, -1, PREG_SPLIT_DELIM_CAPTURE );
    }

    public function wp_kses_attr_parse( $element ) {
        $valid = preg_match( '%^(<\s*)(/\s*)?([a-zA-Z0-9]+\s*)([^>]*)(>?)$%', $element, $matches );
        if ( 1 !== $valid ) {
            return false;
        }

        $begin  = $matches[1];
        $slash  = $matches[2];
        $elname = $matches[3];
        $attr   = $matches[4];
        $end    = $matches[5];

        if ( '' !== $slash ) {
            // Closing elements do not get parsed.
            return false;
        }

        // Is there a closing XHTML slash at the end of the attributes?
        if ( 1 === preg_match( '%\s*/\s*$%', $attr, $matches ) ) {
            $xhtml_slash = $matches[0];
            $attr        = substr( $attr, 0, -strlen( $xhtml_slash ) );
        } else {
            $xhtml_slash = '';
        }

        // Split it.
        $attrarr = $this->wp_kses_hair_parse( $attr );
        if ( false === $attrarr ) {
            return false;
        }

        // Make sure all input is returned by adding front and back matter.
        array_unshift( $attrarr, $begin . $slash . $elname );
        array_push( $attrarr, $xhtml_slash . $end );

        return $attrarr;
    }

    public function wp_kses_one_attr( $string, $element ) {
        $uris              = wp_kses_uri_attributes();
        $allowed_html      = wp_kses_allowed_html( 'post' );
        $allowed_protocols = wp_allowed_protocols();
        $string            = wp_kses_no_null( $string, array( 'slash_zero' => 'keep' ) );

        // Preserve leading and trailing whitespace.
        $matches = array();
        preg_match( '/^\s*/', $string, $matches );
        $lead = $matches[0];
        preg_match( '/\s*$/', $string, $matches );
        $trail = $matches[0];
        if ( empty( $trail ) ) {
            $string = substr( $string, strlen( $lead ) );
        } else {
            $string = substr( $string, strlen( $lead ), -strlen( $trail ) );
        }

        // Parse attribute name and value from input.
        $split = preg_split( '/\s*=\s*/', $string, 2 );
        $name  = $split[0];
        if ( count( $split ) == 2 ) {
            $value = $split[1];

            // Remove quotes surrounding $value.
            // Also guarantee correct quoting in $string for this one attribute.
            if ( '' === $value ) {
                $quote = '';
            } else {
                $quote = $value[0];
            }
            if ( '"' === $quote || "'" === $quote ) {
                if ( substr( $value, -1 ) != $quote ) {
                    return '';
                }
                $value = substr( $value, 1, -1 );
            } else {
                $quote = '"';
            }

            // Sanitize quotes, angle braces, and entities.
            $value = esc_attr( $value );

            // Sanitize URI values.
            if ( in_array( strtolower( $name ), $uris, true ) ) {
                $value = wp_kses_bad_protocol( $value, $allowed_protocols );
            }

            $string = "$name=$quote$value$quote";
            $vless  = 'n';
        } else {
            $value = '';
            $vless = 'y';
        }

        // Sanitize attribute by name.
        wp_kses_attr_check( $name, $value, $string, $vless, $element, $allowed_html );

        // Restore whitespace.
        return $lead . $string . $trail;
    }

    public function get_html_split_regex() {
        static $regex;

        if ( ! isset( $regex ) ) {
            // phpcs:disable Squiz.Strings.ConcatenationSpacing.PaddingFound -- don't remove regex indentation
            $comments =
                '!'             // Start of comment, after the <.
                . '(?:'         // Unroll the loop: Consume everything until --> is found.
                .     '-(?!->)' // Dash not followed by end of comment.
                .     '[^\-]*+' // Consume non-dashes.
                . ')*+'         // Loop possessively.
                . '(?:-->)?';   // End of comment. If not found, match all input.

            $cdata =
                '!\[CDATA\['    // Start of comment, after the <.
                . '[^\]]*+'     // Consume non-].
                . '(?:'         // Unroll the loop: Consume everything until ]]> is found.
                .     '](?!]>)' // One ] not followed by end of comment.
                .     '[^\]]*+' // Consume non-].
                . ')*+'         // Loop possessively.
                . '(?:]]>)?';   // End of comment. If not found, match all input.

            $escaped =
                '(?='             // Is the element escaped?
                .    '!--'
                . '|'
                .    '!\[CDATA\['
                . ')'
                . '(?(?=!-)'      // If yes, which type?
                .     $comments
                . '|'
                .     $cdata
                . ')';

            $regex =
                '/('                // Capture the entire match.
                .     '<'           // Find start of element.
                .     '(?'          // Conditional expression follows.
                .         $escaped  // Find end of escaped element.
                .     '|'           // ...else...
                .         '[^>]*>?' // Find end of normal element.
                .     ')'
                . ')/';
            // phpcs:enable
        }

        return $regex;
    }

    public function wp_kses_hair_parse( $attr ) {
        if ( '' === $attr ) {
            return array();
        }

        // phpcs:disable Squiz.Strings.ConcatenationSpacing.PaddingFound -- don't remove regex indentation
        $regex =
            '(?:'
            .     '[_a-zA-Z][-_a-zA-Z0-9:.]*' // Attribute name.
            . '|'
            .     '\[\[?[^\[\]]+\]\]?'        // Shortcode in the name position implies unfiltered_html.
            . ')'
            . '(?:'               // Attribute value.
            .     '\s*=\s*'       // All values begin with '='.
            .     '(?:'
            .         '"[^"]*"'   // Double-quoted.
            .     '|'
            .         "'[^']*'"   // Single-quoted.
            .     '|'
            .         '[^\s"\']+' // Non-quoted.
            .         '(?:\s|$)'  // Must have a space.
            .     ')'
            . '|'
            .     '(?:\s|$)'      // If attribute has no value, space is required.
            . ')'
            . '\s*';              // Trailing space is optional except as mentioned above.
        // phpcs:enable

        // Although it is possible to reduce this procedure to a single regexp,
        // we must run that regexp twice to get exactly the expected result.

        $validation = "%^($regex)+$%";
        $extraction = "%$regex%";

        if ( 1 === preg_match( $validation, $attr ) ) {
            preg_match_all( $extraction, $attr, $attrarr );
            return $attrarr[0];
        } else {
            return false;
        }
    }
}
