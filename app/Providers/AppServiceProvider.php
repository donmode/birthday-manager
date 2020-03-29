<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Policies\MediumUserPolicy;

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
        //
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
