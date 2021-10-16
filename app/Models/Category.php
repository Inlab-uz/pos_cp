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
}
