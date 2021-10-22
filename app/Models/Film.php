<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    use HasFactory;
    const DOWNLOAD_FULL_CHAPTER = 1;
    const STATUS_PENDING = 0;
    protected $table = 'films';
    protected $fillable = [
        'StrId',
        'Year',
        'Name',
        'status'
    ];
    public function getChapters()
    {
        return $this->hasOne(Chapter::class, 'StrId', 'StrId');
    }
    public function chapters(){
        return $this->hasMany(Chapter::class, 'StrId','StrId');
    }
}
