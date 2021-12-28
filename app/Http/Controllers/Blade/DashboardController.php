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

class DashboardController extends Controller
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


        if ($company == null)
            // later need to implement error message
            abort(404);

        $company_id = $company->id;


        $yearly = self::yearly($company_id);


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


        return view('pages.dashboard', compact('orders_price', 'orders_count', 'today', 'yearly'));

    }


    public static function yearly($company_id)
    {
        //where('company_id', '=', $company_id)
        $orders = Order::where('company_id', '=', $company_id)->groupBy(function ($date) {
            return Carbon::parse($date->created_at)->format('m');
        });

        $ordermcount = [];
        $ordertcount = [];
        $orderArr = [];
        $m = [];
        $c = [];
        $s = [];

        foreach ($orders as $key => $value) {

            $ordermcount[(int)$key] = count($value);
            $ordertcount[(int)$key] = number_format($value->sum('total_price') / 1000, '1');


        }


        $month = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

        $sum = 0;
        for ($i = 1; $i <= 12; $i++) {
            if (!empty($ordermcount[$i])) {
                $orderArr[$i]['count'] = $ordermcount[$i];
                $c[] = $ordermcount[$i];
                $s[] = $ordertcount[$i];
                $sum = $sum + $ordertcount[$i];
            } else {
                $orderArr[$i]['count'] = 0;
                $c[] = 0;
                $s[] = 0;
            }
            $orderArr[$i]['month'] = $month[$i - 1];
            $m[] = $month[$i - 1];
        }

        $stat = [
            "months" => $m,
            "counts" => $c,
            "sums" => $s,
            "sum" => $sum
        ];


        return $stat;
    }
}
