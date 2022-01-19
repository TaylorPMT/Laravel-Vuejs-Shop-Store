<?php

namespace CMS\Frontend\Http\Controllers;

use App\Http\Controllers\BaseController;
use CMS\Frontend\Repository\FrontendRepository;
use Illuminate\Http\Request;

class HomeController extends BaseController
{

    public $_home;
    public function __construct(FrontendRepository $frontendInterface)
    {
        $this->_home = $frontendInterface;
    }

    public function home(Request $request)
    {
        $category =
            $this->_home->categoryProduct(1);
        $news = $this->_home->news(5);
        return view('Frontend.pages.index.index', compact('category', 'news'));
    }

    public function gallery()
    {
        $data = $this->_home->category();
        if (empty($data)) {
            abort('404');
        }
        return view('Frontend.pages.gallery.gallery', compact('data'));
    }

    public function intro()
    {
        return view('Frontend.pages.intro.intro');
    }

    public function category(Request $request)
    {
        $data = $this->_home->productsByCategory($request);

        if (empty($data)) {
            abort('404');
        }
        $category =
            $this->_home->category();
        $breadcrumb = [
            [
                'name' => 'Trang chủ',
                'url' => '/',
                'children' => true,
            ],
            [
                'name' => $data->name,
                'url' => route('frontend.product.category', ['url' => $request->url]),
                'children' => false,
            ],
        ];
        $product = $this->_home->productsFindCategory($data->id);

        return view('Frontend.pages.product.category', compact('data', 'breadcrumb', 'category', 'product'));
    }

    public function products(Request $request)
    {
        $data = $this->_home->products($request);

        if (empty($data)) {
            abort('404');
        }
        $breadcrumb = [
            [
                'name' => 'Trang chủ',
                'url' => '/',
                'children' => true,
            ],
            [
                'name' => !empty($data->category) ? $data->category->name : 'Category',
                'url' =>
                !empty($data->category) ? route('frontend.product.category', ['url' => $data->category->link]) : route('frontend.home'),
                'children' => true,
            ],
            [
                'name' => $data->name,
                'url' => 'test',
                'children' => false,
            ]
        ];
        return view('Frontend.pages.product.detail', compact('data', 'breadcrumb'));
    }

    public function newDetail(Request $request)
    {
        $data = $this->_home->newsDetail($request);

        if (empty($data)) {
            abort(404);
        }

        return view('Frontend.pages.news.detail', compact('data'));
    }
}