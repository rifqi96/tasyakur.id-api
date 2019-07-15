<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['id', 'name'];

    protected $hidden = [
        'created_at', 'updated_at',
    ];

    public function users()
    {
        return $this->hasMany('App\Models\User');
    }

    public function permissions()
    {
        return $this->belongsToMany('App\Models\Permission', 'role_permissions', 'role_id', 'permission_id')->withTimestamps();
    }

    /**
     * Check whether the role has access to given permission
     * 
     * @param string $permission
     * 
     * @return bool
     */
    public function hasAccess(string $permission) : bool
    {
        return $this->permissions->where('name', $permission)->first() ? true : false;
    }
}
