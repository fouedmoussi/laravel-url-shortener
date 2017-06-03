<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Models\Link;

class CheckLinksNumber
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
        if (Link::count() >= 100 || Auth::user()->links()->count() >= 10) {
            return response('Unauthorized.', 401);
        }

        return $next($request);
    }
}
