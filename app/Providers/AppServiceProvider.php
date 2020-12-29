<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Repositories\Auth\AuthRepository;
use App\Repositories\Auth\AuthRepositoryInterface;
use Illuminate\Support\Facades\View;
use App\Models\Khoi;
use App\Models\Lop;
use App\Models\HocSinh;
use App\Models\User;

use App\Observers\KhoiObserver;
use App\Observers\LopObserver;
use App\Observers\HocSinhObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(
            \App\Repositories\BaseRepository::class,
            \App\Repositories\RepositoryInterface::class
        );

        $this->app->bind(AuthRepositoryInterface::class, AuthRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Khoi::observe(KhoiObserver::class);
        Lop::observe(LopObserver::class);
        HocSinh::observe(HocSinhObserver::class);
    }
}