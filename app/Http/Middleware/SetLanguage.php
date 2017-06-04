<?php

namespace App\Http\Middleware;

use Closure;

class SetLanguage
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {   if(!in_array($request->lang , ['en', 'fr']))
        {
           return redirect()->route($request->route()->getName(), ['lang' => 'en']); 
        }
        app()->setLocale($request->lang == 'fr' ? 'fr' : 'en');
        return $next($request);
    }
}
