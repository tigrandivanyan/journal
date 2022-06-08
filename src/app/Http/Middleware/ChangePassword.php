<?php

namespace App\Http\Middleware;

use Closure;

class ChangePassword
{
    public function handle($request, Closure $next)
    {
        if (auth()->check()) {
            $user = auth()->user();
            if ($user->change_password) {
                return redirect(route('user-change-password-get'));
            }
        }
        return $next($request);
    }
}
