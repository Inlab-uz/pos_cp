<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Import extends Model
{
    use HasFactory;

    protected $table = 'imports';

    protected $fillable = [
        'category_id',
        'product_id',
        'discount_id',
        'measure',
        'quantity',
        'part',
        'price',
        'sale_price',
        'nds',
        'date_produce',
        'date_expire',
        'created_at',
        'updated_at',
    ];

    public static $createRules = [
        'product_id'=>'required',
        'quantity'=>'required',
        'price'=>'required',
        'sale_price'=>'required',

    ];

    public static $updateRules = [
        'product_id'=>'required',
        'quantity'=>'required',
        'price'=>'required',
        'sale_price'=>'required',

    ];

    public function category(){
        return $this->belongsTo();
    }

    public function product(){
        return $this->belongsTo();
    }

    public function discount(){
        return $this->belongsTo();
    }
}
