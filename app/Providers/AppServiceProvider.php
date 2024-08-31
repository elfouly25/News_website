<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Middleware\RedirectIfAuthenticated;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Support\Facades\Session;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Redirect an Authenticated User to dashboard
        RedirectIfAuthenticated::redirectUsing(function($request) {
            if ($request->user() && $request->user()->isAdmin()) { // Check if the user is authenticated and is an admin
                return route('login.success'); // Redirect to the dashboard
            }
            return route('admin.login'); // Otherwise, show the login page
        });

        // Redirect No Authenticated User to Admin Login page 
        Authenticate::redirectUsing(function() {
            Session::flash('fail', 'You must be logged in to access the admin area. Please login to continue.');
            return route('admin.login');
        });
    }
}