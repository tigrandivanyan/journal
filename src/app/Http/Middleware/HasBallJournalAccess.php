<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class HasBallJournalAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::check()) {
            $user = Auth::user();
            if ($user->isAn('ball-technician') || $user->isAn('admin') || $user->isAn('ball-technician-admin')) {
                return $next($request);
            }
        }

        return redirect(route('index'));

    }
}
