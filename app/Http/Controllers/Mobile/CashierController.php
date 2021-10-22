<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use App\Models\Cashier;
use App\Models\Category;
use App\Models\Import;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class CashierController extends MobileResponseController
{
    public function search(Request $request){
        $cashier = Cashier::find(auth()->user()->id);
        $categories = Category::where('branch_id', $cashier->branch_id)->get();
        if ($categories){
            foreach ($categories as $category){
                $product = Product::where('barcode_number', $request->barcode_number)->where('category_id', $category->id)->first();
            }
            if ($product){
                return $this->success($product);
            }
            return $this->error('Mahsulot topilmadi!');
        }
        return $this->error('Mahsulot topilmadi!');
    }
    public function orderCreate(Request $request){

    }
}
