<?php

namespace CMS\Frontend\Http\Controllers;

use App\Http\Controllers\BaseController;

class HomeController extends BaseController
{
    public function home()
    {
        return view('Frontend.pages.index.index');
    }

    public function gallery()
    {
        return view('Frontend.pages.gallery.gallery');
    }

    public function intro()
    {
        return view('Frontend.pages.intro.intro');
    }
}