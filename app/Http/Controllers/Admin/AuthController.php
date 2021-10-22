<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends BaseController
{
    //
    protected $__prefix = 'BackEnd.';
    public function login()
    {
        return view($this->__prefix . 'login.login');
    }
}
