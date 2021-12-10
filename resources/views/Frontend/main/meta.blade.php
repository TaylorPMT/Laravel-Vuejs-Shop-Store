<!-- if template contains 'product'  -->
<meta property="og:type" content="product" />
<meta property="og:title" content="{{ product.title | strip_html | strip_newlines  }}" />
<meta property="og:image:secure_url" content="https:{{ product.featured_image.src | product_img_url: 'grande'  | remove: 'http:'}}" />
<meta property="og:price:amount" content="{{ product.price | money_without_currency | remove: ',' | remove: '₫', | remove:'đ'}}" />
<meta property="og:price:currency" content="{{ shop.currency }}" />
<meta property="og:image" content="https:{{ product.featured_image.src | product_img_url: 'grande'  | remove: 'http:'}}" />
<meta property="product:retailer_item_id" content="{{product.id}}">
<!-- elsif template contains 'collection' -->
<meta property="og:type" content="website" />
<meta property="og:title" content="{{ collection.title | strip_html | strip_newlines }}" />
<meta property="og:image" content="http:{{ src }}" />
<meta property="og:image:secure_url" content="https:{{ src }}" />
<!-- elsif template contains 'article' -->
<meta property="og:type" content="article" />
<meta property="og:title" content="{{ article.title | strip_html | strip_newlines }}" />
<meta property="og:image" content="http:{{ src }}" />
<meta property="og:image:secure_url" content="https:{{ src }}" />
<!-- endif  -->
<!-- else -->
<meta property="og:type" content="website"/>
<meta property="og:title" content="{{ page_title | strip_html | strip_newlines }}" />
<meta property="og:image" content="http:{{ 'share_fb_home.png' | asset_url }}" />
<meta property="og:image" content="https:{{ 'share_fb_home.png' | asset_url }}" />
<meta property="og:image:secure_url" content="https:{{ 'share_fb_home.png' | asset_url }}" />
<meta property="og:image:secure_url" content="http:{{ 'share_fb_home.png' | asset_url }}" />
<meta property="og:description" content="{{ page_description | strip_html | strip_newlines }}" />
<meta property="og:url" content="{{ canonical_url  | remove: 'http:'}}" />
<meta property="og:site_name" content="{{ shop.name }}" />