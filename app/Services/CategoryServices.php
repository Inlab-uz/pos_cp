<?php


namespace App\Services;


use App\Models\Category;
use App\Models\Company;

class CategoryServices
{

    public static function categoryCreate($request = [])
    {
        $company_id = self::companyid();
        $branch_id = self::branch_id($company_id);

        $user_id = auth()->user()->id;
        $category = Category::create(
            [
                "name" => $request['name'],
                "parent_id" => $request['parent_id'],
                "company_id" => $company_id,
                "branch_id" => $branch_id,
                "logo" => "1",
                "status" => '1',
                "user_id" => $user_id
            ]
        );
        return $category;
    }

    public static function categoryUpdate($request = [])
    {
        $company_id = self::companyid();
        $branch_id = self::branch_id($company_id);
        $user_id = auth()->user()->id;
        $category = Category::where('id', $request['id'])->first();
        $category->name = $request['name'];
        $category->parent_id = $request['parent_id'];
        $category->company_id =$company_id;
        $category->branch_id = $branch_id;
        $category->logo = "2";
        $category->status = "2";
        $category->user_id = $user_id;
        $category->update();
        return $category;
    }

    //    STATIC FUNCTIONS ==================================================
    public static function companyid()
    {

        $companies = auth()->user()->companies;

        foreach ($companies as $company) {
            $company_id = $company['id'];
            return $company_id;
        }
    }

    public static function branch_id($company_id)
    {

        $company = Company::where('id', $company_id)->first();
        $branches = $company->branches;

        foreach ($branches as $branch) {
            $branch_id = $branch['id'];
            return $branch_id;
        }
    }

}
