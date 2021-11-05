<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderStoreRequest;
use App\Models\Branch;
use App\Models\Cashier;
use App\Models\Category;
use App\Models\Company;
use App\Models\Import;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request) {
        $orders = new Order();
        if($request->start_date) {
            $orders = $orders->where('created_at', '>=', $request->start_date);
        }
        if($request->end_date) {
            $orders = $orders->where('created_at', '<=', $request->end_date . ' 23:59:59');
        }
        $orders = $orders->with(['items', 'payments', 'customer'])->latest()->paginate(10);

        $total = $orders->map(function($i) {
            return $i->total();
        })->sum();
        $receivedAmount = $orders->map(function($i) {
            return $i->receivedAmount();
        })->sum();

        return view('orders.index', compact('orders', 'total', 'receivedAmount'));
    }

    public function store(OrderStoreRequest $request)
    {

        $order = Order::create([
            'customer_id' => $request->customer_id,
            'user_id' => $request->user()->id,
        ]);

        $cart = $request->user()->cart()->get();
        foreach ($cart as $item) {
            $order->items()->create([
                'price' => $item->price,
                'quantity' => $item->pivot->quantity,
                'product_id' => $item->id,
            ]);
            $item->quantity = $item->quantity - $item->pivot->quantity;
            $item->save();
        }
        $request->user()->cart()->detach();
        $order->payments()->create([
            'amount' => $request->amount,
            'user_id' => $request->user()->id,
        ]);
        return 'success';
    }

    public function create(Request $request)
    {
        $cart = $request->all();
        $company = Company::where('user_id', auth()->user()->id)->first();
        $cashier = Cashier::where('company_id', $company->id)->first();
        $branch = Branch::where('company_id', $company->id)->first();
        $category = Category::where('company_id', $company->id)->first();
        $order = (new Order())->add($request->all());
        foreach ($cart['barcode'] as $key => $value){
            $product = Product::where('barcode_number', $value)->where('category_id', $category->id)->first();
            $import = Import::where('product_id', $product->id)->first();
            $orderItem = (new OrderItem())->addWeb($order->id, $import, $product->id, $cart['count'][$key]);
            $import->part = ($import->quantity) - ($cart['count'][$key]);
            $import->update();
        }
        $ex = OrderItem::where('order_id', $order->id)->get();
        $summ = 0;
        foreach ($ex as $e) {

            $cashier_name = $cashier->name;
            $product = Product::find($e->product_id);
            $product_title = $product->title;
            $barcode = $product->barcode_number;
            $order_id = $e->order_id;
            $count = $e->count;
            $price = $e->price;
            $all_price[] = $e->total_price;
            $total_price= $e->total_price;


            $discount = $e->discount;
            $data[] = [
                'title' => $product_title,
                'order_id' => $order_id,
                'count' => $count,
                'price' => $price,
                'total_price' => $total_price,
                'barcode_number' => $barcode,
                'discount' => $discount,
                'company_name' => $company->name,
                'branch_name' => $branch->name,
                'cashier_name' => $cashier->name,
                'date' => Carbon::now()
            ];
            $summ += $total_price;
        }
        return (new PDFController)->generatePDF($data, $summ);
    }
}
