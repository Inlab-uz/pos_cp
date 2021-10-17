<?php
/*
 * InLab Group Copyright (c)  2021.
 *
 * Created by Fatulloyev Shukrullo
 * Please contact before making any changes
 *
 * Tashkent, Uzbekistan
 */

namespace App\Http\Controllers;

use App\Models\Import;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ImportController extends Controller
{
    public function index(){
        $imports = Import::latest()->paginate(40);
        return view('pages.import.index',[
            'imports'=>$imports,
        ]);
    }

    public function create(){
        return view('pages.import.create');
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(),Import::$createRules);
        if($validator->fails()){
            if($validator->fails()){
                return back()->withErrors($validator)->withInput();
            }
        }
        $import = new Import();
        $import->category_id=1;
        $import->product_id=$request->product_id;
        $import->discount_id=1;
        $import->measure=$request->measure;
        $import->quantity=$request->quantity;
        $import->part=$request->quantity;
        $import->price=$request->price;
        $import->sale_price=$request->sale_price;
        $import->nds=$request->nds;
        $import->date_produce=date("Y-m-d H:i:s");
        $import->date_expire=date("Y-m-d H:i:s");
        $import->save();
        return redirect()->route('importIndex')->with("success","Saved!");
    }

    public function getBarCode(Request $request){
        $data = [
                'id'=>"10",
                'name'=>"Zizi",
                'bar_code'=>"123456",
            ];
        return response()->json($data);
    }

}
