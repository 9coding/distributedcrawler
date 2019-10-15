<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;

class BaseController extends Controller {
    
    private $viewData = [];
    
    private $currentController = '';
    
    private $currentAction = '';

    public function __construct(Request $request) {
        $this->middleware('admin')->except(['login', 'dologin']);
        App::setLocale('zh');
        list($class, $this->currentAction) = explode('@', $request->route()->getActionName());
        $this->currentController = strtolower(str_replace('Controller', '', substr(strrchr($class, '\\'), 1)));
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
