<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use App\Http\Helpers\NotificationHelper;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        NotificationHelper::errorResponse('Please login first');
        return $request->expectsJson() ? null : route('auth.login');
    }
}
