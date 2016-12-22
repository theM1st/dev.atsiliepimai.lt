<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Category;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \Form::component('birthday', 'components.form.birthday', ['value']);
        \Form::component('tools', 'components.form.tools', ['tools']);
        \Form::component('categoriesHierarchy', 'components.form.categoriesHierarchy', ['name', 'categories', 'value']);

        \Validator::extend('check_password', function ($attribute, $value, $parameters, $validator) {
            return \Hash::check($value, \Auth::user()->password);
        });

        View::share('mainCategories', Category::getMainCategories());
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
