<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

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
        Gate::define('isAdmin', function($user)
          {
            return $user->account_type == 'admin';
          });
        Gate::define('is_bank_cm', function($user)
          {
            return $user->account_type == 'bank_cm';
          });
        Gate::define('is_teller', function($user)
          {
            return $user->account_type == 'bank_teller';
          });
        //
    }
}
