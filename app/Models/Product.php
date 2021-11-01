<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function imports()
    {
        return $this->hasOne(Import::class);
    }

    public function import()
    {
        return $this->hasOne(Import::class)->where('part','>',0)->orderBy('sale_price');
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
