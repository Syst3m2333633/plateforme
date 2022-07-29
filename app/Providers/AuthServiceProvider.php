<?php

namespace App\Providers;

use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('client_create', fn(User $user) => $user->is_admin);
        Gate::define('client_index', fn(User $user) => $user->is_admin);
        Gate::define('client_indexation', fn(User $user) => $user->is_admin);
        Gate::define('client_search', fn(User $user) => $user->is_admin);

        //
    }
}
