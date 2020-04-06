<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Validation;

class AppServiceProvider extends ServiceProvider
{
    protected  $policies = [
        MediumUser::class => MediumUserPolicy::class,
    ];
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(Validation::class, function($app){
            $controller = request()->route()->getAction()['controller'];
            list($controller, ) = explode('@', $controller);
            $controller =  explode("\\", $controller);
            $controller = $controller[count($controller)-1];
            $prefix = ucfirst(str_ireplace('controller', '', $controller));
            $class = 'App\\'.$prefix.'Validation';
            spl_autoload_register(function ($class) {
                include $class . '.php';
            });
            return new $class();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
//        $this->registerPolicies();
    }
}
