<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Category extends Model
{
    protected $table = "category";

    protected $fillable = [
        'name',
        'parent_id',
        'company_id',
        'branch_id',
        'logo',
        'status',
        'manager_id',
    ];

    public function parent(){
        return $this->hasOne(self::class, 'id', 'parent_id');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function child(){
        return self::where('parent_id', $this->id)->get();
    }
    public function imports()
    {
        return $this->hasMany(Import::class);
    }
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
