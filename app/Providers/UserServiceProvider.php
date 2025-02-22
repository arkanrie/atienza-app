<?php

namespace App\Providers;


use App\Services\UserServices;
use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void

    {
        $this->app->singleton(UserServices::class, function($app){

            $users = [
                [
                'name' => 'john doe',
                'gender' => 'male'
            ],
    
            [
                'name' => 'jane doe',
                'gender' => 'female'
            ]
        ];
        return new UserServices($users);
    
        });
        
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
