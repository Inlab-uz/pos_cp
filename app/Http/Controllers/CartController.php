<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function index(Request $request)
    {


        if ($request->wantsJson()) {
            return response(
                $request->user()->cart()->get()
            );
        }


        $company = auth()->user()->companies->first();
        if ($company == null) {
            $products = [];
            return view('pages.cart.index', compact('products'));
        }

        $categories = Category::where("company_id", $company->id)->get();


        $_products = [];

        foreach ($categories as $index => $category) {
            $products = Product::where("category_id", $category->id)
                ->with('import')
                ->get()
                ->whereNotNull('import')
                ->toArray();

            if (count($products) != 0) {
                $_products = array_merge($_products, $products);
            }

        }

        $products = $_products;


        return view('pages.cart.index', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'barcode' => 'required|exists:products,barcode',
        ]);
        $barcode = $request->barcode;

        $cart = $request->user()->cart()->where('barcode', $barcode)->first();
        if ($cart) {
            // update only quantity
            $cart->pivot->quantity = $cart->pivot->quantity + 1;
            $cart->pivot->save();
        } else {
            $product = Product::where('barcode', $barcode)->first();
            $request->user()->cart()->attach($product->id, ['quantity' => 1]);
        }

        return response('', 204);
    }

    public function changeQty(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = $request->user()->cart()->where('id', $request->product_id)->first();
        if ($cart) {
            $cart->pivot->quantity = $request->quantity;
            $cart->pivot->save();
        }

        return response([
            'success' => true
        ]);
    }

    public function delete(Request $request, $id)
    {
        $request->validate([
            'product_id' => 'required|integer|exists:products,id'
        ]);

        $request->user()->cart()->detach($request->product_id);

        return response('', 204);
    }

    public function empty(Request $request)
    {
        $request->user()->cart()->detach();

        return response('', 204);
    }

    public function v2index(Request $request)
    {
        $company = auth()->user()->companies->first();

        $sales = DB::table('products')
            ->where('company_id', $company->id)
            ->leftJoin('order_items','products.id','=','order_items.product_id')
            ->selectRaw('products.*, COALESCE(sum(order_items.count),0) total')
            ->groupBy('products.id')
            ->orderBy('total','desc')
            ->take(30)
            ->get();



        $_products = [];
        foreach ($sales as $index => $category) {
            $products = Product::where("id", $category->id)
                ->with('import')
                ->get()
                ->whereNotNull('import')
                ->toArray();

            if (count($products) != 0) {
                $_products = array_merge($_products, $products);
            }

        }

        $products = $_products;




        return view('pages.cart.cart', compact('products', "company"));
    }

    public function v2searchBarcode(Request $request)
    {
        $cid = $request->route('cid');
        $barcode = $request->route('barcode');


        $product = Product::where(['barcode_number' => $request->barcode], ['company_id', $cid])->with('imports')->first();

        if ($product == null) {
            return [
                "status" => false,
                "message" => "Maxsulot Topilmadi!"
            ];
        }

        $result = [
            "status" => true,
            "product" => $product,
             "message" => "Maxsulot mavjud!"
        ];
        return response()->json($result);
    }


    public function v2searchProduct(Request $request)
    {
        $cid = $request->route('cid');
        $key = $request->route('key');


        $products = Product::where([['title', 'LIKE' ,"%$key%"], ['company_id', $cid]])->with('imports')->get();

        if (count($products) == 0) {
            return [
                "status" => false,
                "message" => "Maxsulot Topilmad i!"
            ];
        }

        $result = [
            "status" => true,
            "products" => $products,
             "message" => "Maxsulot mavjud!"
        ];
        return response()->json($result);
    }
}
