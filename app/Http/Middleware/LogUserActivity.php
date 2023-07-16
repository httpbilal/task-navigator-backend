<?php

namespace App\Http\Middleware;

use App\Models\ActivityLog;
use Closure;
use Illuminate\Http\Request;


class LogUserActivity
{
    public function handle(Request $request, Closure $next)
    {
        // Log the user activity
        $activityLog = new ActivityLog();
        $activityLog->url = $request->fullUrl();
        $activityLog->method = $request->method();
        $activityLog->email = $request->email;
        $activityLog->ip = $request->ip();
        $activityLog->user_agent = $request->header('User-Agent');
        $activityLog->save();

        return $next($request);
    }
}
