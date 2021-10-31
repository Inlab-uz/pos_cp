<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\Product\ProductResource;
use App\Models\Category;
use App\Models\Import;
use App\Models\PayType;
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
        $category = Category::where('meneger_id', auth()->user()->id)->get();
        return $this->success(CategoryResource::collection($category));
    }

    public function getProductByCategory(Request $request)
    {
        $products = Product::where('category_id', $request->category_id)->get();
        return $this->success(ProductResource::collection($products));
    }
    public function getProductById(Request $request)
    {
        $products = Product::find($request->product_id);
        $import = Import::where('product_id', $products->id)->first();
        $data['product'] = $products;
        $data['import'] = $import;
        return $this->success($data);
    }

    public function getProductByBarCode(Request $request)
    {
        $categories = Category::where('meneger_id', auth()->user()->id)->get();
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
//        $product = (new GlobalService())->search($request->barcode);
//        dd(count($product->original['products']));

//        if (count($product->original['products']) != 0)
//            return $this->success($product->original['products'][0]);
        return $this->error('product not found!');
    }

    public function addProduct(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'barcode_number' => 'required|unique:products,barcode_number'
        ]);
        if ($validator->fails())
            return $this->validationError($validator->errors());
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
//        dd($products);
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

    public function categoryCreate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);
        if ($validator->fails())
            return $this->validationError($validator->errors());

        $category = CategoryServices::categoryCreate($request->all());
        if ($category)
            return $this->success($category);
        return $this->error('Ma\'lumot yoq!');
    }

    public function categoryUpdate(Request $request)
    {
        $category = CategoryServices::categoryUpdate($request->all());
        if ($category)
            return $this->success($category);
        return $this->error('Ma\'lumot yoq!');
    }

    public function payType()
    {
        $pay_type = PayType::all();
        return $this->success($pay_type);
    }
//    BASE64 IMG
    public function uploadBase64Img(Request $request)
    {
        if ($request->hasFile('image')) {
            if ($request->file('image')->isValid()) {

                $image = base64_encode(file_get_contents($request->file('image')->path()));
                return $this->success($image);
            }
        }
        return $this->error('error');
    }
    public function decodeBase64Img(Request $request){
        $img_info = $request->input('image');
        if (preg_match('/^data:image\/(\w+);base64,/', $img_info, $type)) {

            $img_info = substr($img_info, strpos($img_info, ',') + 1);

            $type = strtolower($type[1]); // jpg, png, jpeg

            if (!in_array($type, [ 'jpg', 'jpeg', 'png' ])) return ['success' => false, 'message' => 'Invalid image type.', 'name' => null ];

            $img_info = str_replace( ' ', '+', $img_info );

            $image = base64_decode($img_info);
            if ($image === false)
                return [
                    'success' => false,
                    'message' => 'Base64 decode failed.',
                    'name'    => null
                ];

            $image_name = time()."-".uniqid().".".$type;

            if(request()->has('is_test') && request()->is_test)
                file_put_contents(public_path('upload/test_images/').$image_name, $image);
            else
                file_put_contents(public_path('upload/images/').$image_name, $image);

            return [
                'success' => true,
                'name' => $image_name
            ];
        } else {
            return [
                'success' => false,
                'message' => 'Did not match data URI with image data.',
                'name'    => null
            ];
        }
    }


}
