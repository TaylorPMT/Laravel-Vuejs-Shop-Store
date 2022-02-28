<?php

namespace CMS\Page\Models;

use Illuminate\Database\Eloquent\Model;
use Shortcode;

class Block extends Model
{
    protected $table = 'block';
    protected $guarded = [];
    protected $casts = [
        'image' => 'json',
        'json_block' => 'json'
    ];
    protected $appends   = [
        'block',
        'data_content'
    ];

    public function getBlockAttribute()
    {
        return collect(config('block'))->where('id', $this->attributes['folder'])->first();
    }

    public function getDataContentAttribute()
    {
        $data = json_decode($this->attributes['json_block'], true);
        $data =  Shortcode::compile($data['data_content']);

        return $data;
    }
}
