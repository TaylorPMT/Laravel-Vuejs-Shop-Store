<?php

namespace CMS\Product\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\TraitModel;

class Product extends Model
{
    use HasFactory;
    use TraitModel;
    public $table = 'products';
    protected $casts = [
        'image' => 'json',
    ];
    public function setImageAttribute($value)
    {
        $this->attributes['image'] = json_encode($value);
    }

    public function secureDeleteTrait($id)
    {
        return true;
    }
}