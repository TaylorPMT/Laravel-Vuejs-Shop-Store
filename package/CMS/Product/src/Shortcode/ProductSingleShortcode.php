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
                $html = "<ul class=\"list-product-content\">";
                foreach ($sku as $item) {
                    $productImage = asset($item->image[0] ?? 'default');
                    $productName = $item->name;
                    $productSlug = route('frontend.product', ['url' => $item->link]);
                    $html .= "
                                   <li class=\"$shortcode\">
                                      <div class=\"box-img\">
                                         <a href=\"\" title=\"$item->name\">
                                         <img src=\"$productImage\" alt=\"$productName\">
                                         </a>
                                      </div>
                                      <div class=\"detail\">
                                         <p class=\"title-pro\">
                                            <a href=\"$productSlug\" title=\"$productName\">
                                            $productName</a>
                                         </p>

                                      </div>
                                      <div class=\"box-button\">
                                         <a href=\"$productSlug\" title=\"$productName\" class=\"btn-detail\">Chi tiết</a>
                                      </div>
                                   </li>
                                   ";
                }
                $html .= "</ul>";
                return $html;
            }
        }
    }
}