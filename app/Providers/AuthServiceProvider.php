<?php

namespace App\Providers;

use App\User;
use Laravel\Passport\Passport;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
         'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Passport::routes();
        Passport::tokensExpireIn(now()->addMinutes(60));

        \Gate::define('view',function(User $user,$model){
            return $user->hasAccess("view_{$model}") || $user->hasAccess("edit_{$model}");
        });
        \Gate::define('edit',function(User $user,$model){
           return $user->hasAccess("edit_{$model}");
        });
        \Gate::define('delete',function(User $user,$model){
            return $user->hasAccess("delete_{$model}");
        });
    }
}
