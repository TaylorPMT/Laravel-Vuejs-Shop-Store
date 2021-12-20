<?php

namespace CMS\Menu\Models;

use App\Traits\TraitModel;
use CMS\Category\Models\Category;
use CMS\Menu\JsonModels\HasJsonRelationships;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use TraitModel;
    // use HasFactory;
    // use HasJsonRelationships;
    public $table = 'menus';

    protected $guarded = [];
    protected $casts = [
        'category_id' => 'json'
    ];

    public function getCategoryIdAttribute()
    {
        return is_array($this->attributes['category_id']) ? $this->attributes['category_id'] : collect(json_decode($this->attributes['category_id'], true));
    }

    public function scopeCategorys($query, $data)
    {
        $array_json = collect($data->category_id)->pluck('id')->toArray();
        return Category::whereIn('id', $array_json)->get();
    }
}