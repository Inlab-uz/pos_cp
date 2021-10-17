<?php

namespace App\Models;

use App\Http\Traits\HasFilters;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory, HasFilters;

    protected $table = 'companies';

    protected $fillable = [
        'user_id',
        'name',
        'logo',
        'description',
    ];
}
