<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\TipoActividad;

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
        \Illuminate\Support\Facades\Route::model(
        'tiposActividad',
        \App\Models\TipoActividad::class
        );
    }
}
