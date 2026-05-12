<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Gate::define('admin', fn($user) => $user->role === 'admin');
        Gate::define('owner', fn($user) => $user->role === 'owner');
        Gate::define('customer', fn($user) => $user->role === 'customer');
    }
}
