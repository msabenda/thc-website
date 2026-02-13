<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    protected function redirectTo($request)
    {
        // Redirect admin requests to admin login
        if ($request->is('admin') || $request->is('admin/*')) {
            return route('admin.login');
        }

        // Redirect normal users (if you have any)
        return route('login'); // you can remove this if you don't have a normal login
    }
}
