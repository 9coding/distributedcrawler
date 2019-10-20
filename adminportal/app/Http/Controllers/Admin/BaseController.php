<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class BaseController extends Controller {
    
    private $viewData = [];
    
    private $currentController = '';
    
    private $currentAction = '';

    public function __construct(Request $request) {
        $this->middleware('auth:admin');//使用Kernel.php下routeMiddleware定义的auth中间件
        App::setLocale('zh');
        list($class, $this->currentAction) = explode('@', $request->route()->getActionName());
        $this->currentController = strtolower(str_replace('Controller', '', substr(strrchr($class, '\\'), 1)));
    }
    
    public function getUser($info = '') {
        $user = Auth::guard('admin')->user();
        if ($info && isset($user[$info])) {
            return $user[$info];
        }
        return $user;
    }
    
    protected function assign($key = '', $value = '') {
        if (is_array($key)) {
            foreach ($key as $assignKey => $assignValue) {
                $this->viewData[$assignKey] = $assignValue;
            }
        } else {
            $this->viewData[$key] = $value;
        }
    }
    
    protected function display($page = '') {
        if (!$page) {
            $page = strtolower($this->currentController.'.'.$this->currentAction);
        }
        return view('admin.'.$page, $this->viewData);
    }
}
