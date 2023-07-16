<?php

namespace App\Http\Middleware;

use App\Models\ActivityLog;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogUserActivity
{
    public function handle(Request $request, Closure $next)
    {
        // Check if the user is authenticated
        if (Auth::check()) {
            // Get the authenticated user
            $user = Auth::user();

            // Log the user activity
            $activityLog = new ActivityLog();
            $activityLog->email = $user->email;
            $activityLog->token = $user->api_token;
        } else {
            // Log the activity for unauthenticated users
            $activityLog = new ActivityLog();
            $activityLog->email = null;
            $activityLog->token = null; 
        }

        // Log the common details
        $activityLog->url = $request->fullUrl();
        $activityLog->method = $request->method();
        $activityLog->ip = $request->ip();
        $activityLog->user_agent = $request->header('User-Agent');
        $activityLog->save();

        return $next($request);
    }
}
