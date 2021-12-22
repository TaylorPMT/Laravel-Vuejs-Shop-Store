<?php

namespace CMS\Frontend\Repository;

use App\Repository\BaseRepository;
use CMS\Category\Models\Category;
use CMS\Category\Repository\CategoryInterface;
use CMS\Menu\Models\Menu;
use CMS\Product\Models\Product;

class FrontendRepository extends BaseRepository implements CategoryInterface
{
    public $_category;
    public $_menus;
    public $_product;
    public function __construct(Category $category, Menu $menu, Product $product)
    {
        $this->_category = $category;
        $this->_menus = $menu;
        $this->_product = $product;
    }

    public function category()
    {
        $data = $this->_category->get();
        return $data;
    }

    public function menus()
    {

        $data = $this->_menus->orderBy('order', 'asc')->get();
        return $data;
    }

    public function productsByCategory($request)
    {
        $data = $this->_category->with(['products' => function ($query) {
            $query->paginate(config('general.product.paginate'));
        }])->where('link', $request->url)->first();
        return $data;
    }

    public function products($request)
    {
        $data = $this->_product->where(function ($query)  use ($request) {
            if (!empty($request->url)) {
                $query->where('link', $request->url)->orWhere('id', $request->link);
            }
        })->first();

        return $data;
    }
}