<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RedisTaskSaveController extends Controller
{
    //
        $tasks = Task::orderBy('priority', 'desc')->take(10)->get();

        Redis::set('top_tasks', $tasks->toJson());
}
