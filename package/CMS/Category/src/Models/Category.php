<?php

namespace CMS\Category\Models;

use App\Traits\TraitModel;
use CMS\Product\Models\Product;
use Database\Factories\CategoryFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use TraitModel;
    use HasFactory;
    public $table = 'categories';
    protected $guarded = [];
    protected $casts = [
        'image' => 'json',
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }

    public function setImageAttribute($value)
    {
        $this->attributes['image'] = json_encode($value);
    }

    protected static function newFactory()
    {
        return CategoryFactory::new();
    }

    public function secureDeleteTrait($id)
    {
        $category =
            Category::find($id);
        return $category->secureDelete('products');
    }

    public function scopeProductsCategory($query)
    {
        return $this->products()->orderBy('created_at')->take(5)->get();
    }
}
