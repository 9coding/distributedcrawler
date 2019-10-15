<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider {

    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot() {
        Route::pattern('id', '[0-9]+');//路由参数整体正则定义
        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map() {
        $this->mapApiRoutes();
        $this->mapAdminRoutes();//为了确保子域名路由是可访问，应该在注册根域名路由之前注册子域名路由。这将防止根域名路由覆盖具有相同 URI 路径的子域名路由。
        $this->mapWebRoutes();
    }

    /**
     * Define the "admin" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapAdminRoutes() {
        Route::domain(config('app.admin_domain'))
               ->middleware('web')
               ->namespace($this->namespace.'\Admin')
               ->group(base_path('routes/admin.php'));
    }
    
    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes() {
        Route::middleware('web')
               ->namespace($this->namespace.'\Home')
               ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes() {
        Route::prefix('api')
               ->middleware('api')
               ->namespace($this->namespace.'\Api')
               ->group(base_path('routes/api.php'));
    }

}
