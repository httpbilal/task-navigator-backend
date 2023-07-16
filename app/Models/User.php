<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;
use App\Models\Task;
use Illuminate\Support\Facades\Redis;


class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'firstname',
        'lastname',
        'image',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'created_at',
        'updated_at'
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }


    public function tasks()
    {
        return $this->belongsToMany(Task::class, 'users_tasks');
    }

//     public static function boot()
// {
//     parent::boot();

//     static::pivotDetaching(function ($model, $relationName, $pivotIds) {
//         if ($relationName === 'tasks') {
//             foreach ($pivotIds as $pivotId) {
//                 $key = 'user_tasks:' . $model->id;
//                 $task = Task::find($pivotId);
//                 Redis::srem($key, $task->toJson());
//             }
//         }
//     });
// }
}
