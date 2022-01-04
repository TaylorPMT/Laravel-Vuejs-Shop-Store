<?php

namespace CMS\News\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{

    public $table = 'news';
    public $guarded = [];
    protected $casts = [
        'image' => 'json',
    ];
    public function newsdetail()
    {
        return $this->hasMany(NewsDetail::class, 'category_id', 'id');
    }
    public function scopeNewsHome($query, $limit, $id_unset)
    {
        return $query->where('id', '<>', $id_unset)->orderBy('created_at')->take($limit)->get();
    }
}