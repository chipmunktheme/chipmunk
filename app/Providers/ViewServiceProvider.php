<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use MadeByLess\Lessi\Helper\SelectorTrait;

class ViewServiceProvider extends ServiceProvider
{
    use SelectorTrait;

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerCustomFunctions();
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function registerCustomFunctions()
    {
        Blade::if('optionEnabled', function ($expression) {
            return true;
        });

        Blade::if('addonEnabled', function ($expression) {
            return false;
        });
    }
}
