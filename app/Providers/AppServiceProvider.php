<?php

namespace App\Providers;

use App\Http\Middleware\LocaleMiddleware;
use Illuminate\Support\Facades\Route;
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
    public function boot(): void
    {
        $this->routes(function () {
            Route::middleware(['web', LocaleMiddleware::class])
                ->group(base_path('routes/web.php'));

            Route::middleware('api')
                ->group(base_path('routes/api.php'));
        });
    }

    private function routes(\Closure $param)
    {
    }
}
