<?php

namespace CMS\Menu\Models;

use App\Traits\TraitModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use TraitModel;
    use HasFactory;
    public $table = 'menus';

    protected $guarded = [];
    protected $casts = [
        'category_id' => 'json'
    ];
}