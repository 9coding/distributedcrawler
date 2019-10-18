<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;

class IndexController extends Controller {
    
    public function __construct() {
        $this->middleware('guest')->except('logout');
    }

    public function index() {
        return view('welcome');
    }
}
