<?php

namespace App\Providers;

use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(Request $request): void
    {
        $path_array = $request->segments();
        $admin_route = config('app.admin_route');

        if(in_array($admin_route, $path_array)){
            config(['app.app_scope'=>'admin']);
        }
        $app_scope = config('app.app_scope');

        if ($app_scope == 'admin'){
            $path = resource_path('views/Admin');
        }else{
            $path = resource_path('views/front-end');
        }
        view()->addLocation($path);

    }
}
