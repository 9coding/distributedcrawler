<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\UserLogin;

class IndexController extends BaseController {

    public function login() {
        return $this->display();
    }
    
    public function dologin(UserLogin $request) {
        $postdata = $request->validated();
        echo '<pre>';
        print_r($postdata);exit;
    }
}
