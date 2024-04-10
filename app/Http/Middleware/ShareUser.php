<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;

class ShareUser
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
        view()->share('currentUser', Auth::user());

        if(Auth::user()) {
            $user = Auth::user();
            Bugsnag::registerCallback(function ($report) use ($user) {
                $report->setUser($user->toArray());
            });
        }

        return $next($request);
    }
}
