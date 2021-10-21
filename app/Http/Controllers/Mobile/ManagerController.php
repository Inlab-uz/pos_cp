<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\Product\ProductResource;
use App\Models\Category;
use App\Models\Import;
use App\Models\Product;
use App\Models\ProductLocal;
use App\Models\Unit;
use App\Services\Barcode\GlobalService;
use App\Services\CategoryServices;
use App\Services\ImportService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;

class ManagerController extends MobileResponseController
{
    public function getCategory()
    {
        $category = Category::where('user_id', auth()->user()->id)->get();
        return $this->success(CategoryResource::collection($category));
    }

    public function getProductByCategory(Request $request)
    {
        $products = Product::where('category_id', $request->category_id)->get();
        return $this->success(ProductResource::collection($products));
    }

    public function getProductByBarCode(Request $request)
    {
        $categories = Category::where('user_id', auth()->user()->id)->get();
        foreach ($categories as $category) {
            $product = Product::where('barcode_number', $request->barcode)->where('category_id', $category->id)->first();
        }
        if ($product) {
            return $this->success($product);
        }
        $product = ProductLocal::where('barcode_number', $request->barcode)->first();
        if ($product) {
            return $this->success($product);
        }
        $product = (new GlobalService())->search($request->barcode);
        if (isset($product->original['products']))
            return $this->success($product->original['products'][0]);
        return $this->error('product not found!');
    }

    public function addProduct(Request $request)
    {
//        $validator = Validator::make($request->all(),[
//           'barcode_number' =>  'required|unique:products,barcode_number'
//        ]);
//        if ($validator->fails())
//            return $this->validationError($validator->errors());
        $import = \App\Services\Product::productCreate($request->all());
        if ($import)
            return $this->success();
        return $this->error('Ma\'lumot saqlanmadi!');
    }

    public function updateProduct(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'barcode_number' => 'required'
        ]);
        if ($validator->fails())
            return $this->validationError($validator->errors());
        $import = \App\Services\Product::productUpdate($request->all());
        if ($import)
            return $this->success();
        return $this->error('Ma\'lumot saqlanmadi!');
    }

    public function measurement()
    {
        $products = Category::with('products')->first();
dd($products);
        $unit = Unit::all();

        return $this->success($unit);
    }

    public function importUpdate(Request $request)
    {
        $import = ImportService::importUpdate($request->all());
        if ($import)
            return $this->success($import);
        return $this->error('Ma\'lumot saqlanmadi!');
    }

    public function getAllImport()
    {
        $import = Import::all();
        if ($import)
            return $this->success($import);
        return $this->error('Ma\'lumot yoq!');
    }

    public function showImport(Request $request)
    {
        $import = Import::where('id', $request->id)->first();
        if ($import)
            return $this->success($import);
        return $this->error('Ma\'lumot yoq!');
    }
    public function categoryCreate(Request $request){
        CategoryServices::categoryCreate($request->all());
    }
    public function categoryUpdate(Request $request){
       $category = CategoryServices::categoryUpdate($request->all());
       if ($category)
           return $this->success($category);
        return $this->error('Ma\'lumot yoq!');
    }


}
