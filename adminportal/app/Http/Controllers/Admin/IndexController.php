<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

class IndexController extends BaseController {

    public function index() {
        echo '<pre>';
        print_r($this->userInfo);exit;
        return $this->display();
    }
}
