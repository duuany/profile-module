<?php

namespace Modules\Profile\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class ProfilePolicyProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    public function boot()
    {
        Gate::define('profile', function ($user, $profile) {
            return $user->id == $profile->user_id;
        });

        Gate::define('profile.access', function ($user, $value) {
            return $user[config('profile.user.route-key-name')] == $value;
        });
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
