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
        'user_id',
    ];

    public function parent(){
        return $this->hasOne(self::class, 'id', 'parent_id');
    }

    public function user(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function child(){
        return self::where('parent_id', $this->id)->get();
    }
}
