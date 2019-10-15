<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckAdmin {

    public function handle($request, Closure $next) {
        $guard = Auth::guard('admin');
        if (!$guard->check() || !$guard->user()->is_admin) {
            return redirect()->route('login');
        }
        return $next($request);
    }

}
