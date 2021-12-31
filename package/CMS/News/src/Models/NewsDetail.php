<?php

namespace CMS\News\Models;

use Illuminate\Database\Eloquent\Model;

class NewsDetail extends Model
{
    public $table = 'new_detail';
    protected $guarded = [];
    protected $casts = [
        'image' => 'json',
    ];

    public function news()
    {
        return $this->belongsTo(News::class, 'category_id');
    }

    public function newsDetail($query, $limit, $id_unset)
    {
        return $query->where([['id', '<>', $id_unset]])->take($limit)->get();
    }

    public function setImageAttribute($value)
    {
        $this->attributes['image'] = json_encode($value);
    }
}