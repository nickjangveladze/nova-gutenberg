<?php

namespace Jangvel\NovaGutenberg;

use Illuminate\Support\ServiceProvider;
use Laravel\Nova\Events\ServingNova;
use Laravel\Nova\Nova;

class FieldServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Nova::serving(function (ServingNova $event) {
            Nova::script("nova-gutenberg-react", "https://unpkg.com/react@16.8.6/umd/react.production.min.js");
            Nova::script("nova-gutenberg-react-dom", "https://unpkg.com/react-dom@16.8.6/umd/react-dom.production.min.js");
            Nova::script('nova-gutenberg', __DIR__ . '/../dist/js/field.js');
            Nova::script('nova-gutenberg-laraberg', public_path('/vendor/laraberg/js/laraberg.js'));
            Nova::style('nova-gutenberg-laraberg', public_path('/vendor/laraberg/css/laraberg.css'));
            Nova::style('nova-gutenberg', __DIR__ . '/../dist/css/field.css');
        });
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
