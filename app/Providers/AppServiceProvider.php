<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\http\Resources\CourseResource;

class AppServiceProvider extends ServiceProvider
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
        // Remove 'Data' object wrapping the Json Response for the CourseResource
        CourseResource::withoutWrapping();
    }
}
