<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use App\Http\Resources\Product\ProductIndexResource;
use App\Models\Company;
use App\Models\Product;
use Illuminate\Http\Request;


class MobileResponseController extends Controller
{
    public function searchProductByName(Request $request)
    {
        $company = Company::where('user_id', $request->user()->id)->first();
        $products = Product::query()->where('title', 'like', '%' . $request->title . '%')->where('company_id', $company->id)->get();
        if ($products){
            return self::success(ProductIndexResource::collection($products));
        }
        return self::error('topilmadi');
    }

    public function upload(Request $request)
    {
        if ($request->hasFile('image')) {
            if ($request->file('image')->isValid()) {

                $image = base64_encode(file_get_contents($request->file('image')->path()));
                return $this->success($image);
            }
        }
        return $this->error('error');
    }


    public function success($data = [])
    {
        return response()->json([
            'status' => true,
            'data' => $data,
            'message' => 'Muvofaqqiyatli!'
        ]);
    }

    public function error($message)
    {
        return response()->json([
            'status' => false,
            'data' => [],
            'message' => $message
        ]);
    }

    function validationError($array)
    {
        $array = $array->toArray();
        foreach ($array as $key => $value) {
            foreach ($value as $k => $v) {
                return $this->errorMessage($v);
            }
        }
    }

    function errorMessage($code = 1)
    {
        if (is_int($code))
            return $code;
        elseif (is_string($code))
            return response()->json([
                'status' => false,
                'data' => [],
                'message' => [
                    'uz' => $code,
                    'ru' => $code,
                    'en' => $code,
                ]]);
        return response()->json([
            'status' => false,
            'data' => [],
            'message' => $code
        ]);
    }
}
