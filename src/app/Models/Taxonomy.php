<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Taxonomy extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    public function terms()
    {
        return $this->belongsToMany('App\Models\Term', 'term_taxonomies', 'taxonomy_id', 'term_id')->withTimestamps();
    }
}
