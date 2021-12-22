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
        if (!$cashier){
            $company = Company::where('user_id',auth()->user()->id)->first();
            $cashier = Cashier::where('company_id', $company->id)->first();
        }
        return self::create([
            'company_id' => $cashier->company_id,
            'branch_id' => $cashier->branch_id,
            'cashier_id' => $cashier->id,
            'manager_id' => $cashier->manager_id,
            'pay_type' => $params['pay_type']
        ]);
    }

    public function items(){
        return $this->hasMany(OrderItem::class, 'order_id', 'id');
    }

    public function company(){
        return $this->belongsTo(Company::class);
    }

    public function branch(){
        return $this->belongsTo(Branch::class);
    }

    public function manager(){
        return $this->belongsTo(Meneger::class);
    }

    public function cashier(){
        return $this->belongsTo(Cashier::class);
    }
}
