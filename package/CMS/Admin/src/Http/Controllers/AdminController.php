<?php

namespace CMS\Admin\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Laravel\Passport\Token;


class AdminController extends BaseController
{

    public function getSidebar(Request $request)
    {
        $config_name = $request->config;
        $config = config($config_name);
        return $this->responseJson(null, 200, 'Thành công', $config);
    }
    public function getInfo(Request $request)
    {
        return $this->responseJson(null, 200, 'Thành công', Auth::user());
    }
    public function getList(Request $request)
    {

        $query = User::orderBy('created_at', 'desc');
        $data = $query->paginate(15);
        return $this->responseJson(null, 200, 'Thành công', $data);
    }
    public function path(Request $request)
    {
        return view('BackEnd.pages.index');
    }
}
