<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Models\ActivityLog;
class TrackUserNavigation
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
        ActivityLog::create(
        ['access_date_time' => date('Y-m-d H:i:s', $_SERVER['REQUEST_TIME']),
             'visited_link' => $request->fullUrl(),
             'ip_address' => $request->ip(),
             'country' => GeoIP($request->ip())->country,
             'user_agent' => $request->server('HTTP_USER_AGENT'),
             'user_id' => $request->user() ? $request->user()->id : null,
        ]);
       
        return $next($request);
    }
}
