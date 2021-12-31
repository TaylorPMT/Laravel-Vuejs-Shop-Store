<?php

namespace CMS\News\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{

    public $table = 'news';
    public $guarded = [];

    public function scopeNewsHome($query, $limit, $id_unset)
    {
        return $query->where('id', '<>', $id_unset)->orderBy('created_at')->take($limit)->get();
    }
}