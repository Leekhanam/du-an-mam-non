<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use App\Models\NamHoc;
class ViewServiceProvider extends ServiceProvider
{
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
        // Using class based composers...
        // View::composer(
        //     'profile', 'App\Http\View\Composers\ProfileComposer'
        // );

        // Using Closure based composers...
        View::composer('*', function ($view) {
            $view->with('nam_hoc_share', NamHoc::orderBy('id', 'desc')->get());
        });
    }
}