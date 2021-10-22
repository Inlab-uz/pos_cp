<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meneger extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'menegers';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
