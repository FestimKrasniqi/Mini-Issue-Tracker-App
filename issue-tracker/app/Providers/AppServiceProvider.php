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
        // Force HTTPS in production
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }

        // Trust proxy headers from Render
        Request::setTrustedProxies(['*'], Request::HEADER_X_FORWARDED_ALL);
    }
}


