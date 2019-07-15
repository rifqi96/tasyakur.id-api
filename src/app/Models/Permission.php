<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    public function roles()
    {
        return $this->belongsToMany('App\Models\Role', 'role_permissions', 'permission_id', 'role_id')->withTimestamps();
    }
}
