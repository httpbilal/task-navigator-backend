<?php
namespace App\Listeners;

use Illuminate\Support\Facades\Redis;

class UserDeletedListener
{
    // ...

    public function handle($user)
    {
        Redis::del('user_tasks:' . $user->id);
    }
}
