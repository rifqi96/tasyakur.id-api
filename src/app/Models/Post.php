<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at', 'published_at'];

    /**
     * The attributes that should be cast to native types.
     * 
     * @var array
     */
    protected $casts = [
        'is_featured' => 'boolean'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'media_id',
        'slug',
        'title',
        'excerpt',
        'is_featured',
        'status',
        'published_at'
    ];

    public function author()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function featuredImg()
    {
        return $this->belongsTo('App\Models\Media');
    }

    public function terms()
    {
        return $this->belongsToMany('App\Models\Term', 'post_terms', 'post_id', 'term_id')->withTimestamps();
    }

    public function details()
    {
        return $this->hasMany('App\Models\PostMeta');
    }
}
