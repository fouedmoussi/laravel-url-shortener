<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
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
        ['access_date_time' => Carbon::now(),
             'visited_link' => $request->url(),
             'ip_address' => $request->ip(),
             'country' => GeoIP($request->ip())->country,
             'user_agent' => $request->server('HTTP_USER_AGENT'),
             'user_id' => $request->user() ? $request->user()->id : null,
        ]);
       
        return $next($request);
    }
}
