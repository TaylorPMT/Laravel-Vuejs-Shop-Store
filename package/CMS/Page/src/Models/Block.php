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
}