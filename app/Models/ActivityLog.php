<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class ActivityLog extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'activity_logs';
    protected $fillable = [
        'url', 'method', 'payload', 'ip', 'user_agent', 'payload',  'response'
    ];
}
