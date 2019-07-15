<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Term extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
    ];

    public function taxonomies()
    {
        return $this->belongsToMany('App\Models\Taxonomy', 'term_taxonomies', 'term_id', 'taxonomy_id')->withTimestamps();
    }

    public function posts()
    {
        return $this->belongsToMany('App\Models\Post', 'post_terms', 'term_id', 'post_id')->withTimestamps();
    }
}
