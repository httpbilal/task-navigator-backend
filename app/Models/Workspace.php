<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workspace extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'owner_id'];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function owner()
    {
        return $this->hasOne(User::class, 'owner_id');
    }
}
