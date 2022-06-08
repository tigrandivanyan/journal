<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\View;
use Closure;
use App\Studio;

class HasAdminPanelAccess
{
    public function handle($request, Closure $next)
    {
        if (auth()->check()) {
            $user = auth()->user();
            if ($user->can('access-admin-panel')) {
                return $next($request);
            }
        }
        return back();
    }
}
