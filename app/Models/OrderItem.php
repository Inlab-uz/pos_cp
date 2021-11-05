<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function add($id, $import, $params){
//        dd($import);
        return self::create([
            'order_id' => $id,
            'product_id' => $params['product_id'],
            'count' => $params['product_count'],
            'price' => (($import->sale_price + $import->discount)/100),
            'total_price' => ($import->sale_price + (($import->sale_price + $import->discount)/100)) * $params['product_count'],
            'measure_id' => $import->measure_id,
            'discount' => $import->discount
        ]);
    }
    public function addWeb($id, $import, $product_id, $count){
        return self::create([
            'order_id' => $id,
            'product_id' => $product_id,
            'count' => $count,
            'price' => $import->sale_price + (($import->sale_price * $import->discount)/100),
            'total_price' => ($import->sale_price + (($import->sale_price * $import->discount)/100)) * $count,
            'measure_id' => $import->measure_id,
            'discount' => $import->discount
        ]);
    }
}
