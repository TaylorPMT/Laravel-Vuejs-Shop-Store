<?php

namespace CMS\Product\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\TraitModel;
use CMS\Category\Models\Category;
use Laravel\Scout\Searchable;
use Shortcode;

class Product extends Model
{
    use HasFactory;
    use TraitModel;
    use Searchable;
    public $table = 'products';
    const BUFFER = 10;
    const SEARCHABLE_FIELDS = [
        'id',  'name'
    ];
    protected $guarded = [];
    protected $casts = [
        'image' => 'json',
    ];

    public function setImageAttribute($value)
    {
        $this->attributes['image'] = json_encode($value);
    }

    public function secureDeleteTrait($id)
    {
        return Product::find($id)->delete();
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function searchableAs()
    {
        return 'products_index';
    }


    public function toSearchableArray()
    {
        return $this->only(self::SEARCHABLE_FIELDS);
    }

    public function getContentAttribute()
    {

        return Shortcode::compile($this->attributes['content']);
    }
}