<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workspace extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'owner'];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function ownerUser()
    {
        return $this->belongsTo(User::class, 'owner');
    }
}
