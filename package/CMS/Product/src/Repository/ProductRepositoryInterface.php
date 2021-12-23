<?php


namespace CMS\Product\Repository;

use App\Repository\BaseInterface;

interface ProductRepositoryInterface extends BaseInterface
{
    public function getProductBySku($sku);
}
