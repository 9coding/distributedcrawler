<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

class IndexController extends BaseController {

    public function index() {
        $user = $this->getUser();
        echo '<pre>';
        print_r($user);exit;
        return $this->display();
    }
}
