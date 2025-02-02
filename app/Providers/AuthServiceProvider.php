<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // กำหนด Gate เพื่อควบคุมการแสดงเมนู
        Gate::define('can-view-function', function ($user) {
            return $user->status->user_status_name === 'admin';
        });
    }
}
