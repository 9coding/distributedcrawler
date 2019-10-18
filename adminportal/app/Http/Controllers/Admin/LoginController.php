<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller {

    use AuthenticatesUsers;

    protected function validateLogin(Request $request) {
        $request->validate([
            $this->username() => 'required|string',
            'password' => 'required|string',
            'captcha_code' => 'required|captcha'
                ], [
            'captcha_code.required' => trans('validation.required'),
            'captcha_code.captcha' => trans('validation.captcha'),
        ]);
    }

    public function username() {
        return 'admin_email';
    }

    protected function redirectTo() {
        return route('home');
    }

    protected function guard() {
        return Auth::guard('admin');
    }

}
