<?php

namespace App\Http\Controllers\LogController;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;

class Log_activityController extends Controller
{
    // getting the user data
    public function index()
    {
        $ActivityLogs = ActivityLog::all();
        return response()->json(['Activity_Logs' => $ActivityLogs]);
    }

    // getting data of specific user

    public function show($email)
    {
        $log = ActivityLog::where('email', $email)->first();
        if (!$log) {
            return response()->json(['error' => 'LogActivity not found'], 404);
        }
        return response()->json(['Log' => $log]);
    }

    // Delete the User Log Activity Record
    public function destroy($email)
    {
        $log = ActivityLog::where('email', $email)->first();
        if (!$log) {
            return response()->json(['error' => 'Log Record already deleted'], 404);
        }

        $log->delete();

        return response()->json(['message' => 'Log Record deleted successfully']);
    }
}
