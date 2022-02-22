<?php

namespace CMS\Page\Models;

use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    protected $table = 'block';
    protected $guarded = [];
    protected $casts = [
        'image' => 'json',
        'json_block' => 'json'
    ];
    protected $appends   = [
        'block'
    ];

    public function getBlockAttribute()
    {
        return collect(config('block'))->where('id', $this->attributes['folder'])->first();
    }
}