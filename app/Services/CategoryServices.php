<?php


namespace App\Services;


use App\Models\Category;
use App\Models\Company;
use App\Models\Meneger;

class CategoryServices
{

    public static function categoryCreate($request = [])
    {
        $company_id = self::companyid();
        $branch_id = self::branch_id($company_id);

        $manager_id = auth()->user()->id;

        $category = Category::create(
            [
                "name" => $request['name'],
                "parent_id" => 0,
                "company_id" => $company_id,
                "branch_id" => $branch_id,
                "logo" => "1",
                "meneger_id" => $manager_id,
                "status" => '1',
            ]
        );
        return $category;
    }

    public static function categoryUpdate($request = [])
    {
        $company_id = self::companyid();
        $branch_id = self::branch_id($company_id);
        $manager_id = auth()->user()->id;
        $category = Category::where('id', $request['id'])->first();
        $category->name = $request['name'];
        $category->parent_id = 0;
        $category->company_id =$company_id;
        $category->branch_id = $branch_id;
        $category->logo = "2";
        $category->status = "2";
        $category->meneger_id = $manager_id;
        $category->update();
        return $category;
    }

    //    STATIC FUNCTIONS ==================================================
    public static function companyid()
    {

        $company = Meneger::find(auth()->user()->id);
        return $company->id;
    }

    public static function branch_id($company_id)
    {

        $company = Meneger::find(auth()->user()->id);
        return $company->branch_id;
    }

}
