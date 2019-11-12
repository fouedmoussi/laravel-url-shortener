<?php

namespace App\Http\Middleware;

use App\Models\Link;
use Closure;
use Illuminate\Support\Facades\Auth;

class CheckLinksNumber
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Link::count() >= 100 || Auth::user()->links()->count() >= 10) {
            return redirect()->route('user-links', ['lang' => app()->getLocale()])->with('warning', 'Unauthorized to create more then 10 links');
        }

        return $next($request);
    }
}
