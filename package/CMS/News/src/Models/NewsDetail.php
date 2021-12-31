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
    public function setImageAttribute($value)
    {
        $this->attributes['image'] = json_encode($value);
    }
}