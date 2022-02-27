<?php

namespace CMS\Product\Shortcode;

use CMS\Product\Repository\ProductRepositoryInterface;
use CMS\Frontend\Library\Shortcode;

class ProductSingleShortcode
{
    const shortcode_name = 'product-item';
    public $productRepository;
    public function __construct(ProductRepositoryInterface $product)
    {
        $this->productRepository = $product;
    }

    public function register($shortcode, $content, $compiler, $name, $viewData)
    {

        if ($shortcode->sku) {
            $skuArr = array_unique(array_map('trim', explode(',', $shortcode->sku)));
            $sku = $this->productRepository->getProductBySku($skuArr);
            if ($sku) {
                $shortcode = self::shortcode_name;
                $html = "<div class=\"block-product productRelated\">";
                foreach ($sku as $item) {
                    $productImage = asset($item->image[0] ?? 'default');
                    $productName = $item->name;
                    $productSlug = route('frontend.product', ['url' => $item->link]);
                    $html .= "<div class=\"$shortcode\">
                                   <div class=\"$shortcode text-center\">
                                      
                                         <a class=\"product-img\" href=\"$productSlug\" title=\"$item->name\">
                                         <img src=\"$productImage\" alt=\"$productName\"
                                         class=\"block-product\"
                                         >
                                         </a>
                                     
                                      <div class=\"product-info\">
                                         <p class=\"title-pro product-info__title\">
                                            <a href=\"$productSlug\" title=\"$productName\">
                                            $productName</a>
                                         </p>

                                      </div>
                                      <div class=\"box-button\">
                                         <a href=\"$productSlug\" title=\"$productName\" class=\"btn-detail\">Chi tiết</a>
                                      </div>
                                   </div>
                                  </div> ";
                }
                $html .= "</div>";
                return $html;
            }
        }
    }
}