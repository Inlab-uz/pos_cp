<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MobileResponseController extends Controller
{
    public function success($data = []){
        return response()->json([
            'status' => true,
            'data' => $data,
            'message' => 'Muvofaqqiyatli!'
        ]);
    }
    public function error($message){
        return response()->json([
            'status' => false,
            'data' => [],
            'message' => $message
        ]);
    }
    function validationError($array){
        $array = $array->toArray();
        foreach ($array as $key => $value){
            foreach ($value as $k => $v) {
                return $this->errorMessage($v);
            }
        }
    }
    function errorMessage($code = 1){
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
