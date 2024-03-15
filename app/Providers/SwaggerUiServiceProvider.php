<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class SwaggerUiServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // always access to the swagger-ui
        Gate::define('viewSwagger', fn($user = null) => true);
    }
}
