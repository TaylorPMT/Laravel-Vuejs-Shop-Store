<?php

namespace CMS\Category\Models;

use App\Models\Product;
use Database\Factories\CategoryFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    public $table = 'categories';
    protected $guarded = [];

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }

    protected static function newFactory()
    {
        return CategoryFactory::new();
    }
}
