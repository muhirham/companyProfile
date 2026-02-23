<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Brand;

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
            view()->composer('layouts.userLayouts', function ($view) {
        $footerBrands = Brand::where('is_active', 1)->get();
        $view->with('footerBrands', $footerBrands);
    });
    }
}
