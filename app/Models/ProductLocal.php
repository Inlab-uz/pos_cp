<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductLocal extends Model
{
    use HasFactory;
    protected $table = 'products_local';
    protected $guarded = [];
}
