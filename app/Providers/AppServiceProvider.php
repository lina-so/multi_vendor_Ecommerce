<?php

namespace App\Providers;

use App\View\Composer\CartCount;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use App\View\Components\nav\SidebarNavAdmin;

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
        Paginator::useBootstrapFive();

        Validator::extend('filter',function($attribute,$value,$params){
            return !in_array(strtolower($value), $params);
        },'this :attribute is blocked.');

        Validator::extend('phone_number', function ($attribute, $value, $parameters, $validator) {
            // Define your regular expression for phone numbers
            return preg_match("/^\d+\s\d+$/", $value);
        });

        view()->composer(['layouts.*','layouts.front.front-layout'], CartCount::class);
    }
}
