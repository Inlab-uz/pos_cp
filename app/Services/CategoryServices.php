<?php


namespace App\Services;


use App\Models\Category;

class CategoryServices
{
    public static function categoryCreate($request=[]){
       $user_id = auth()->user()->id;
        Category::create(
            [
                "name" => $request['name'],
                "parent_id" => $request['parent_id'],
                "company_id" => $request['company_id'],
                "branch_id" => $request['branch_id'],
                "logo" => "1",
                "status" => '1',
                "user_id" => $user_id
            ]
        );
    }
    public static function categoryUpdate($request=[]){
        $user_id = auth()->user()->id;
        $category = Category::where('id', $request['id'])->first();
        $category->name = $request['name'];
        $category->parent_id = $request['parent_id'];
        $category->company_id = $request['company_id'];
        $category->branch_id = $request['branch_id'];
        $category->logo = "2";
        $category->status = "2";
        $category->user_id = $user_id;
        $category->update();
        return $category;
    }

}
