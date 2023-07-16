<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Support\Facades\Redis;


class Task extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'due_date', 'priority'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'users_tasks');
    }

    protected static function booted()
    {
        static::deleting(function ($task) {
            // Detach all associated users which will trigger UsersTasks model's deleting event
            $task->users()->detach();
        });
    }

    protected $hidden = [
        'created_at',
        'updated_at'
    ];
}
