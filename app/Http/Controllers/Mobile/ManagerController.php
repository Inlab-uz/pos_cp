<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\Product\ProductResource;
use App\Models\Category;
use App\Models\Product;
use App\Services\Barcode\GlobalService;
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
        $product = (new GlobalService())->search($request->barcode);
        if (isset($product->original['products']))
            return $this->success($product->original['products'][0]);
        return $this->error('product not found!');
    }
    public function addProduct(Request $request){
        $product = Product::create($request->all());
        if ($product instanceof Product)
            return $this->success();
        return $this->error('Ma\'lumot saqlanmadi!');
    }
    public function updateProduct(Request $request){

    }
}
