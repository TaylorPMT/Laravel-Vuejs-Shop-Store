<?php

namespace CMS\Frontend\Http\Controllers;

use App\Http\Controllers\BaseController;
use CMS\Frontend\Repository\FrontendRepository;

class HomeController extends BaseController
{

    public $_home;
    public function __construct(FrontendRepository $frontendInterface)
    {
        $this->_home = $frontendInterface;
    }

    public function home()
    {
        return view('Frontend.pages.index.index');
    }

    public function gallery()
    {
        $data = $this->_home->category();
        return view('Frontend.pages.gallery.gallery', compact('data'));
    }

    public function intro()
    {
        return view('Frontend.pages.intro.intro');
    }

    public function category($url)
    {
        return view('Frontend.pages.product.category');
    }
}