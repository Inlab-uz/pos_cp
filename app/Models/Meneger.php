<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Meneger extends Model
{
    use HasFactory, HasApiTokens;
    protected $guarded = [];
    protected $table = 'menegers';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
