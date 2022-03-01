<?php

namespace CMS\Frontend\Http\Controllers;

use App\Http\Controllers\BaseController;
use CMS\Frontend\Repository\FrontendRepository;
use CMS\Menu\Repository\MenuInterface;
use CMS\Page\Repository\BlockRepositoryInterface;
use Illuminate\Http\Request;

class HomeController extends BaseController
{

    public $_home;
    public $_page;
    public function __construct(FrontendRepository $frontendInterface, MenuInterface $page, BlockRepositoryInterface $block)
    {
        $this->_home = $frontendInterface;
        $this->_page = $page;
        $this->_block = $block;
    }

    public function getMac(Request $request){
          //Buffering the output




            \Log::build([
                'driver' => 'single',
                'path' => storage_path('logs/macaddress.log'),
            ])->info('macaddress----------:'.json_encode($request->ipinfo->all));

    }

    public function home(Request $request)
    {

        $this->getMac($request);
        $page = $this->_page->blockPage('home-page');
        $block = $this->_block->loadBlockData($page);

        return view('Frontend.pages.index.index', compact('block'));
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
