<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'workspace_id'];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function workspace()
    {
        return $this->hasOne(Workspace::class, 'workspace_id');
    }
}
