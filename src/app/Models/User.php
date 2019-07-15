<?php

namespace App\Models;

use Laravel\Passport\HasApiTokens;
use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

class User extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable, HasApiTokens;

    /**
     * Set the dates to be timestamps
     * It will also set the dates to automatically update themselves when necessary updates are done
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'deleted_at'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'role_id',
        'first_name',
        'last_name',
        'email',
        'password',
        'bio',
        'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token'
    ];

    /**
     * The default eager loaded relations
     *
     * @var array
     */
    protected $with = [
        'role',
        'role.permissions'
    ];

    public function role()
    {
        return $this->belongsTo('App\Models\Role');
    }

    public function posts()
    {
        return $this->hasMany('App\Models\Post');
    }

    public function profilePicture()
    {
        return $this->belongsTo('App\Models\Media');
    }

    public function setPasswordAttribute(string $password)
    {
        $this->attributes['password'] = Hash::make($password);
    }

    /**
     * Check whether the user is a superadmin
     *
     * @return bool
     */
    public function isSuperAdmin(): bool
    {
        return $this->role_id === 1;
    }

    /**
     * Check whether the user is an editor
     *
     * @return bool
     */
    public function isEditor(): bool
    {
        return $this->role_id === 2;
    }

    /**
     * Check whether the user is a writer
     *
     * @return bool
     */
    public function isWriter(): bool
    {
        return $this->role_id === 3;
    }

    /**
     * Check whether the user can view all posts
     *
     * @return bool
     */
    public function canViewAllPosts(): bool
    {
        return $this->isSuperAdmin() || $this->isEditor();
    }

    /**
     * Find the user instance for the given username or email.
     *
     * @param string $input
     * @return \App\Models\User|null
     */
    public function findForPassport(String $input)
    {
        return $this->where('username', $input)
            ->orWhere('email', $input)
            ->first();
    }
}
