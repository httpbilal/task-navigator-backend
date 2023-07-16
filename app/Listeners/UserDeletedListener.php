<?php

use Illuminate\Support\Facades\Redis;

class UserDeletedListener
{
    // ...

    public function handle($event)
    {
        $user = $event->user;
        Redis::del('user_tasks:' . $user->id);
    }
}
