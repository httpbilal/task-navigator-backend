<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class UserLogService
{
    /**
     * Retrieve user logs from MongoDB.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getUserLogs()
    {
        $logs = DB::connection('mongodb')->table('user_logs')->get();
        // You can process or modify the logs as needed before returning

        return $logs;
    }
}
