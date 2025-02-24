<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Auth;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        // Check if the user is already logged in and trying to access the login page
        if (Auth::check()) {
            // If user is logged in, redirect them to the home page or any other page
            return route('home'); // Replace 'home' with your desired route name
        }

        // If the user is not authenticated, redirect to the login page
        if (! $request->expectsJson()) {
            return route('login');
        }
    }
}
