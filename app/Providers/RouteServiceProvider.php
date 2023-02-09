<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/api';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::prefix('api')
                ->middleware('api')
                ->namespace($this->namespace)
                ->group(function () {
                    Route::prefix('auth')->group(base_path('routes/auth.php'));

                    Route::prefix('settings')->group(base_path('routes/settings.php'));

                    require base_path('routes/api.php');
                });
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            try {
                $by = $request->user()->id;
            } catch (\Throwable $th) {
                $by = $request->ip();
            }

            return Limit::perMinute(60)->by($by);
        });

        RateLimiter::for('phone-verification', function (Request $request) {
            return Limit::perMinute(10)->by($request->ip());
        });
    }
}
