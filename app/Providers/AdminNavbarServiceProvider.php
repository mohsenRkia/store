<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AdminNavbarServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(
            ['admin.layouts.navbar','user.layouts.navbar'], 'App\Http\View\Composers\AdminNavbarComposer'
        );


    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
