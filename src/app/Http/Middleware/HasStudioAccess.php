<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\View;
use Closure;
use App\Studio;

class HasStudioAccess
{
    public function handle($request, Closure $next)
    {
        $studioName = $request->studioName;



//dd($studioId);
//        if (!$studioName) {
//            throw new \Exception("there should be {studioName} param in a route");
//        }
        $studio = Studio::where('name_eng', $studioName)->first();

        View::share('currentStudio', $studio);

        if (!$studioName) {
            return $next($request);
        }

        if (auth()->check() && $studio) {
            $user = auth()->user();
            if ($user->can('view-all-studios')
                || $user->can('view-studio', $studio)
                || $user->can('access-studio-temporary', $studio)
            ) {
                return $next($request);
            }
        }
        return back();
    }
}
