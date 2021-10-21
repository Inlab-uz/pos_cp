<?php


namespace App\Services;


use App\Models\Import;
use Illuminate\Support\Carbon;

class ImportService
{
    public static function importUpdate($request=[]){
        $import = Import::where('id', $request['id'])->first();
        $import->product_id = $request['product_id'];
        $import->category_id = $request['category_id'];
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
}
