<?php


namespace App\Services;


use App\Models\Category;
use App\Models\Import;
use Illuminate\Support\Carbon;

class ImportService
{
    public static function importUpdate($request=[]){

        $import = Import::where('id', $request['id'])->first();
        $import->product_id = self::product_id();
        $import->category_id = self::categoryId();
        $import->discount = $request['discount'];
        $import->measure = $request['measure'];
        $import->quantity = $request['quantity'];
        $import->part = $request['part'];
        $import->sale_price = $request['sale_price'];
        $import->nds = $request['nds'];
        $import->date_produce = Carbon::now();
        $import->date_expire =  Carbon::now();
        $import->update();
        return $import;
    }
//    STATIC FUNCTIONS=====================
    public static function categoryId(){
        $categories = auth()->user()->categories;
        foreach ($categories as $category){
            $category_id = $category['id'];
            return $category_id;
        }
    }
    public static function product_id(){
        $category_id = self::categoryId();
        $category = Category::where('id', $category_id)->first();
          $products =  $category->products;
        foreach ($products as $product){
            $product_id = $product['id'];
            return $product_id;
        }
    }
}
