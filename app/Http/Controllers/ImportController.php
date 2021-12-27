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

use App\Models\Category;
use App\Models\Company;
use App\Models\Import;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ImportController extends Controller
{
    public function index()
    {
        $company = Company::where('user_id', auth()->user()->id)->first();
        if (auth()->user()->hasRole('Super Admin')) {
            $imports = Import::latest()->paginate(20);
        } elseif (auth()->user()->hasRole('Administrator')) {
            $company = Company::where('user_id', auth()->user()->id)->first();
            $category = Category::where('company_id', $company->id)->first();
            $imports = Import::where('category_id', $category->id)->paginate(20);
        }
        return view('pages.import.index', [
            'imports' => $imports,
        ]);
    }

    public function create()
    {
        return view('pages.import.create');
    }


    public function edit(Request $request, Import $import)
    {
        return view('pages.import.create');
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), Import::$createRules);
        if ($validator->fails()) {
            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }
        }
        $import = new Import();
        $import->category_id = 1;
        $import->product_id = $request->product_id;
        $import->discount = $request->discount;
        $import->measure = $request->measure;
        $import->quantity = $request->quantity;
        $import->part = $request->quantity;
        $import->price = $request->price;
        $import->sale_price = $request->sale_price;
        $import->nds = $request->nds;
        $import->date_produce = date("Y-m-d H:i:s");
        $import->date_expire = date("Y-m-d H:i:s");
        $import->save();
        return redirect()->route('importIndex')->with("success", "Saved!");
    }

    public function getBarCode(Request $request)
    {
        $product = Product::where('barcode_number', $request->bar_code)->first();
        $data = [
            'id' => $product->id ?? null,
            'name' => $product->title ?? 'tovar topilmadi',
            'bar_code' => $product->barcode_number ?? null
        ];
        return response()->json($data);
    }

}
