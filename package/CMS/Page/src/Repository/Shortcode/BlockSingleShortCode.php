<?php

namespace CMS\Page\Repository\Shortcode;

use CMS\Category\Repository\CategoryInterface;

class BlockSingleShortCode
{
    const short_code_name = 'category-item';

    private $_categoryRepo;
    public function __construct(CategoryInterface $category)
    {
        $this->_categoryRepo = $category;
    }

    public function register($shortcode, $content, $compiler, $name, $viewData)
    {
        if ($shortcode->sku) {
            $skuArr = array_unique(array_map('trim', explode(',', $shortcode->sku)));

            $skuNumber = array_unique(array_map('trim', explode(',', $shortcode->quantity)));
            $sku = $this->_categoryRepo->getShortCode($skuArr, $skuNumber);
            $shortcode = self::short_code_name;
            // $html = "";
            // foreach ($sku as $item) {
            //     $productImage = asset($item->image[0] ?? 'default');
            //     $productName = $item->name;
            //     $productSlug = route('frontend.product', ['url' => $item->link]);
            //     $productContent = $item->description;
            //     $html .= "
            //     <div class=\"$shortcode col-md-4 col-sm-12\">
            //             <div class=\"block-product\">
            //                     <a class=\"product-img zoom-out\" href=\"$productSlug\">
            //                         <img class=\"lazyload\"
            //                             data-src=\"$productImage\"
            //                             alt=\"\" width=\"390\" height=\"507\">
            //                     </a>
            //                      <div class=\"product-info\">
            //                         <a class=\"product-info__title\" href=\"$productSlug\">$productName</a>
            //                         <div class=\"product-info__detail\">$productContent</div>
            //                     </div>
            //             </div>
            //     </div> ";
            // }
            // $html .= "";
            return json_encode($sku);
        }
    }
}
