<?php

namespace App\Http\Controllers\Mobile;

use App\Models\Cashier;
use App\Models\Category;
use App\Models\Import;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class CashierController extends MobileResponseController
{
    public function search(Request $request)
    {
        $cashier = $request->user();

        if ($cashier instanceof Cashier) {
            $categories = Category::where('branch_id', $cashier->branch_id)->get();
            if ($categories) {
                $product = [];
                foreach ($categories as $category) {
                    $product = Product::where(['barcode_number' => $request->barcode], ['category_id', $category->id])->first();
                }
                if ($product) {
                    $import = Import::where('product_id', $product->id)->first();
                    $sum = (int)($import->sale_price) - (int)(($import->sale_price * $import->discount) / 100);
                    $data = [
                        'id' => $product->id,
                        'name' => $product->title,
                        'price' => $sum,
                        'measure' => $product->measure,
                    ];
                    return $this->success([$data]);
                }
                return $this->error('Mahsulot topilmadi!');
            }
            return $this->error('Mahsulot topilmadi!');
        }
        return $this->error('Siz Kassir emassiz!');
    }

    public function orderCreate(Request $request)
    {
//        dd($request->all());
        $orders = $request->data;
        $export = (new Order())->add($request->all());
        foreach ($orders as $order) {
            $import = Import::where('product_id', $order['product_id'])->first();
            if ($import['measure'] == 1) {
                $summ = ($order['product_count']) * ($import->sale_price);
                $orderItem = (new OrderItem())->add($export->id, $import, $order);
                $import->part = ($import->quantity) - ($order['product_count']);
                $import->update();
            } elseif ($import['measure'] == 2) {
                $summ = ($order['product_count']) * ($import->sale_price);
                $orderItem = (new OrderItem())->add($export->id, $import, $order);
                $import->part = ($import->quantity) - ($order['product_count']);
                $import->update();
            } elseif ($import['measure'] == 3) {
                $summ = ($order['product_count']) * ($import->sale_price);
                $orderItem = (new OrderItem())->add($export->id, $import, $order);
                $import->part = ($import->quantity) - ($order['product_count']);
                $import->update();
            } elseif ($import['measure'] == 4) {

                $summ = ($order['product_count']) * ($import->sale_price);

                $orderItem = (new OrderItem())->add($export->id, $import, $order);
                $import->part = ($import->quantity) - ($order['product_count']);
                $import->update();
            } elseif ($import['measure'] == 5) {
                $summ = ($order['product_count']) * ($import->sale_price);
                $orderItem = (new OrderItem())->add($export->id, $import, $order);
                $import->part = ($import->quantity) - ($order['product_count']);
                $import->update();
            }
        }
        $ex = OrderItem::where('order_id', $export->id)->get();
        dd($ex);
        $summ = 0;
//        dd($ex);
        foreach ($ex as $e) {
            $summ += $e->total_price;
        }
        $export->total_price = $summ;
        $export->update();
        return $this->success($ex);

    }
}
