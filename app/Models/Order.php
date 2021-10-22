<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function add($params){
        $cashier = Cashier::find(auth()->user()->id);
        return self::create([
            'company_id' => $cashier->company_id,
            'branch_id' => $cashier->branch_id,
            'cashier_id' => $cashier->id,
            'manager_id' => $cashier->manager_id,
            'pay_type' => $params['pay_type']
        ]);
    }
}
