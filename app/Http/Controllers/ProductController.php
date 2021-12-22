<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Http\Resources\Product\ProductResource;

use App\Models\Category;
use App\Models\Company;
use App\Models\Import;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{

    public function index(Request $request)
    {

        $key = false;
        $id = auth()->user()->id;
        $company = Company::where('user_id', $id)->first();
        $category = Category::select('id')->where('company_id', $company->id)->get();
        if (auth()->user()->hasRole('Super Admin')){
            $products = Product::latest()->paginate(10);
        }elseif (auth()->user()->hasRole('Administrator')){
            $products = Product::whereIn('category_id', $category)->with('import')->paginate(10);
        }
        if ($request->search) {
            if ($request->key == 'price' || $request->key == 'sale_price' || $request->key == 'quantity'){
                $products = Import::where($request->key, $request->search)->whereIn('category_id', $category)->with('product')->paginate(500);
                $key = true;
                return view('pages.products.index', compact('products', 'key'));
            }
            if ($request->key == 'least'){
                $products = Import::where('part','<', $request->search)->whereIn('category_id', $category)->with('product')->paginate(500);
                $key = true;
                return view('pages.products.index', compact('products', 'key'));
            }
            if ($request->key == 'inactive'){
//                dd(date('Y-m-d', strtotime("-30 days")));
                $products = Import::where( 'updated_at', '<', date('Y-m-d', strtotime("-".$request->search." days")))->whereIn('category_id', $category)->with('product')->paginate(500);
                $key = true;
                return view('pages.products.index', compact('products', 'key'));
            }
            $products = Product::where($request->key, 'LIKE', "%{$request->search}%")->whereIn('category_id', $category)->with('import')->paginate(50);
        }


        if (request()->wantsJson()) {
            return ProductResource::collection($products);
        }

        return view('pages.products.index', compact('products', 'key'));
    }


    public function create()
    {

        $company = auth()->user()->companies->first();

        $categories = Category::where('company_id', $company->id)->get();

        return view('pages.products.create', compact('categories'));
    }


    public function store(ProductStoreRequest $request)
    {

        $image_path = '';

        if ($request->hasFile('image')) {
            $image_path = $request->file('image')->store('products', 'public');
        }

        $category = $request->category;

        $import = \App\Services\Product::productCreate($request->all());

        if (!$import) {
            return redirect()->back()->with('error', 'Sorry, there a problem while creating product.');
        }
        success_message('Success, you product have been created.');
        return redirect()->route('products.index')->with('success', 'Success, you product have been created.');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }


    public function edit(Product $product)
    {
        $import = Import::where('product_id', $product->id)->first();
        return view('pages.products.edit', compact('import', 'product'));
    }


    public function update(ProductUpdateRequest $request, Product $product)
    {
        $import = Import::where('product_id', $product->id)->first();
        $product->title = $request->name;
        $product->description = $request->description;
        $product->barcode_number = $request->barcode_number;
        $import->price = $request->price;
        $import->sale_price = $request->sale_price;
        if ($import->part != $request->quantity){
            $import->quantity = $request->quantity;
            $import->part = $request->quantity;
        }
        $product->status = $request->status;
        $product->update();
        $import->update();
        if ($request->hasFile('image')) {
            // Delete old image
            if ($product->image) {
                Storage::delete($product->image);
            }
            // Store image
            $image_path = $request->file('image')->store('products', 'public');
            // Save to Database
            $product->image = $image_path;
        }

        if (!$product->save()) {
            return redirect()->back()->with('error', 'Sorry, there\'re a problem while updating product.');
        }
        return redirect()->route('products.index')->with('success', 'Success, your product have been updated.');
    }


    public function destroy($product)
    {
        if ($product->image) {
            Storage::delete($product->image);
        }
        $product->delete();

        return response()->json([
            'success' => true
        ]);
    }

    public function delete(Product $product)
    {
        Import::where('product_id', $product->id)->delete();
        if ($product->image) {
            Storage::delete($product->image);
        }
        $product->delete();
        success_message('Success, product have been deleted.');
        return redirect()->back();
    }

    public function search(Request $request)
    {
        $id = auth()->user()->id;
        if (auth()->user()->hasRole('Super Admin')){
            $products = Product::latest()->paginate(10);
        }elseif (auth()->user()->hasRole('Administrator')){
            $company = Company::where('user_id', $id)->first();
            $category = Category::where('company_id', $company->id)->first();
            $products = Product::where('category_id', $category->id)->with('import')->paginate(10);
        }
        if ($request->search) {
            $products = $products->where('name', 'LIKE', "%{$request->search}%");
        }
        if (request()->wantsJson()) {
            return ProductResource::collection($products);
        }

        return view('pages.products.index')->with('products', $products);
    }
}
