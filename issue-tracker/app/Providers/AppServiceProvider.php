<?php

namespace App\Providers;

use App\Policies\ProjectPolicy;
use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    // Add policies as a class property
    protected $policies = [
        ProjectPolicy::class => ProjectPolicy::class,
    ];

    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        
    }

}


