<?php

namespace CMS\Frontend\Repository;

use App\Repository\BaseRepository;
use CMS\Category\Models\Category;
use CMS\Category\Repository\CategoryInterface;
use CMS\Menu\Models\Menu;
use CMS\News\Models\NewsDetail;
use CMS\Product\Models\Product;

class FrontendRepository extends BaseRepository implements CategoryInterface
{
    public $_category;
    public $_menus;
    public $_product;
    public $_news_detail;
    public function __construct(Category $category, Menu $menu, Product $product, NewsDetail $_news_detail)
    {
        $this->_category = $category;
        $this->_menus = $menu;
        $this->_product = $product;
        $this->_news_detail = $_news_detail;
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

    public function news($total_news)
    {
        $data = $this->_news_detail->orderBy('created_at')->take($total_news)->get();
        return $data;
    }
    public function newsDetail($request)
    {
        $data = $this->_news_detail->with(['news'])->where('link', $request->url)->first();

        return $data;
    }
    public function categoryProduct($total)
    {
        $data = $this->_category->with(['products' => function ($query) {
            $query->paginate(config('general.product.paginate'));
        }])->take($total)->get();
        return $data;
    }

    public function productsByCategory($request)
    {
        $data = $this->_category->where('link', $request->url)->first();
        return $data;
    }

    public function productsFindCategory($id_category)
    {
        $data = $this->_product->where('category_id', $id_category)->paginate(config('general.product.paginate'));
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