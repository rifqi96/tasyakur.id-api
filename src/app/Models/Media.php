<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'author_id',
        'media_folder_id',
        'name',
        'alt_txt',
        'file_name',
        'mime_type',
        'disk',
        'size'
    ];

    public function author()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function folder()
    {
        return $this->belongsTo('App\Models\MediaFolder', 'media_folder_id');
    }
}
