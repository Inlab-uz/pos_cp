<?php

namespace App\Http\Controllers\Blade;

use App\Http\Controllers\Controller;
//use App\Http\Requests\OrderStoreRequest;
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
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function dashboard()
    {
        $today = date('Y-m-d');

        $from = $today . " 00:00:00";
        $to = $today . " 23:59:59";

//        MONTH
        $month = date('Y-m-01');
        $month_end = date('Y-m-30') . " 23:59:59";

        $user_id = auth()->user()->id;
        $company = Company::find($user_id);
        $company_id = $company->id;

        $orders_price = DB::table('orders')
            ->where('company_id', '=', $company_id)
            ->where(function ($query) use ($from, $to) {
                $query->whereBetween('created_at', array($from, $to));
            })->sum('total_price');

        $orders_count = Order::where('company_id', $company_id)
            ->where(function ($query) use ($from, $to) {
                $query->whereBetween('created_at', array($from, $to));
            })
            ->get();
        $orders_count = count($orders_count);
        return view('pages.dashboard', compact('orders_price', 'orders_count', 'today'));

    }
}
