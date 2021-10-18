<?php

namespace App\Models;

use App\Http\Traits\HasFilters;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory, HasFilters;
    protected $fillable = [
        'user_id',
        'name',
        'logo',
        'description',
    ];

    public function branches()
    {
        return $this->hasMany(Branch::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getOwner():string
    {
        return (string)($this->user->name ?? 'undefined');
    }

    public function shortDescription():string
    {
        return substr($this->description ?? '',0,50).'...';
    }
}
