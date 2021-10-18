<?php

namespace App\Models;

use App\Http\Traits\HasFilters;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory,HasFilters;
    protected $fillable = [
        'company_id',
        'name',
        'address',
        'phone'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
