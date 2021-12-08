<?php

namespace CMS\Admin\Http\Controllers;

use App\Http\Controllers\BaseController;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Laravel\Passport\Token;


class AuthController extends BaseController
{

    public function username()
    {
        return 'name'; //or return the field which you want to use.
    }
    public function dashboard(Request $request)
    {

        return view('admin::dashboard');
    }
    public function postLogin(Request $request)
    {
        request()->validate([
            'name' => 'required',
            'password' => 'required',
        ]);

        $rememberToken = false;
        if ($request->has('rememberToken')) {
            $rememberToken = true;
        }
        $credentials = request(['name', 'password']);
     
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $tokenResult = $user->createToken('Admin');
            session(['token' => $tokenResult->accessToken]);
            $token = $tokenResult->token;
            if ($rememberToken) {
                $token->expires_at = Carbon::now()->addWeeks(1);
            } else {
                $token->expires_at = Carbon::now()->addDay();
            }
            $token->save();
            $response = [
                'token' => $tokenResult->accessToken,
                'user' => $user
            ];
            return $this->responseJson(null, 200, config('general.success'), $response);
        }
        return $this->responseJson(true, 200, config('general.failed'), 'error');
    }
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return $this->responseJson(null, 200, 'Thành công', "");
    }
}
