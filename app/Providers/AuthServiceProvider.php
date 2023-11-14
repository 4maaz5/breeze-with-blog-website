<?php

namespace App\Providers;

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
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::define('isAdmin', function($post){
            if($post->email === 'admin@gmail.com'){
                return true;
            }
            // elseif($post->email === 'saibkhattak054@gmail.com'){
            //     return true;
            // }
            else{
                return false;
            }
        });
    }
}
