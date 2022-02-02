<?php

namespace FaarenTech\LaravelCustomUuids;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class CustomUuidServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
//        $this->mergeConfigFrom(
//            __DIR__ . "/../config/config.php",
//            'webhook_receiver'
//        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
//        $this->loadMigrationsFrom(__DIR__ . "/../database/migrations");
//        $this->registerEndpointRoute();
//        $this->registerCrudRoutes();
//
//        if($this->app->runningInConsole()) {
//            $this->publishes([
//                __DIR__ . "/../config/config.php" => config_path('webhook_receiver.php')
//            ], 'config');
//        }
    }

//    protected function registerEndpointRoute()
//    {
//        $routeConfig = [
//            'prefix' => config('webhook_receiver.prefix'),
//            'middleware' => config('webhook_receiver.middleware')
//        ];
//        Route::group($routeConfig, function() {
//            $this->loadRoutesFrom(__DIR__ . "/../routes/endpoints.php");
//        });
//    }
//
//    protected function registerCrudRoutes()
//    {
//        $routeConfig = [
//            'prefix' => config('webhook_receiver.crud_prefix'),
//            'middleware' => config('webhook_receiver.crud_middleware')
//        ];
//        Route::group($routeConfig, function() {
//            $this->loadRoutesFrom(__DIR__ . "/../routes/crud.php");
//        });
//    }
}
