<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\Product\ProductResource;
use App\Models\Category;
use App\Models\Import;
use App\Models\Product;
use App\Models\Unit;
use App\Services\Barcode\GlobalService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class ManagerController extends MobileResponseController
{
    public function getCategory(){
        $category = Category::all();
        return $this->success(CategoryResource::collection($category));
    }
    public function getProductByCategory(Request $request){
        $products = Product::all();
        return $this->success(ProductResource::collection($products));
    }
    public function getProductByBarCode(Request $request){
        $product = Product::where('barcode_number', $request->barcode)->first();
        if ($product)
            return $this->success($product);
        $product = (new GlobalService())->search($request->barcode);
        if (isset($product->original['products']))
            return $this->success($product->original['products'][0]);
        return $this->error('product not found!');
    }
    public function addProduct(Request $request){
        $product = Product::create($request->all());
        if ($product instanceof Product){
            $import = new Import();
            $import->category_id = $request->category_id;
            $import->product_id = $product->id;
            $import->discount_id = $request->discount;
            $import->measure = $request->measure;
            $import->quantity = $request->quantity;
            $import->part = $request->quantity;
            $import->price = $request->price;
            $import->sale_price = $request->sale_price;
            $import->nds = $request->nds;
            $import->date_produce = $request->date_produce;
            $import->date_expire = $request->date_expire;
            $import->save();
            return $this->success();
        }
        return $this->error('Ma\'lumot saqlanmadi!');
    }
    public function updateProduct(Request $request){

    }
    public function measurement(){
        $unit = Unit::all();
        return $this->success($unit);
    }
}
