<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

class IndexController extends BaseController {

    public function login() {
        return $this->display();
    }
    
    public function dologin(Request $request) {
        
    }
}
