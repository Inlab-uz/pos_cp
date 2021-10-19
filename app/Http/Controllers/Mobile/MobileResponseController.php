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
}
