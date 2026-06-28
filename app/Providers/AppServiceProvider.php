<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Pagination\Paginator;
use App\Models\Guideline;
use App\Models\Facility;

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

        // Share guidelines to main and catalog layouts
        View::composer(['layouts.main', 'layouts.catalog'], function ($view) {
            $globalGuidelines = Guideline::where('is_active', true)->orderBy('order', 'asc')->get();
            $globalFacilities = Facility::all();
            
            $view->with([
                'globalGuidelines' => $globalGuidelines,
                'globalFacilities' => $globalFacilities
            ]);
        });
    }
}
