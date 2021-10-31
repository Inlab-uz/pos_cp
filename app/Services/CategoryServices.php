<?php


namespace App\Services;


use App\Models\Category;
use App\Models\Company;
use App\Models\Meneger;

class CategoryServices
{

    public static function categoryCreate($request = [])
    {
        $img = 'image.png';//self::decodeBase64Img($request['logo']);
        $company_id = self::companyid();
        $branch_id = self::branch_id($company_id);

        $manager_id = auth()->user()->id;

        $category = Category::create(
            [
                "name" => $request['name'],
                "parent_id" => 0,
                "company_id" => $company_id,
                "branch_id" => $branch_id,
                "logo" => $img,
                "meneger_id" => $manager_id,
                "status" => '1',
            ]
        );
        return $category;
    }

    public static function categoryUpdate($request = [])
    {
        $img = 'image.png';//self::decodeBase64Img($request['logo']);
        $company_id = self::companyid();
        $branch_id = self::branch_id($company_id);
        $manager_id = auth()->user()->id;
        $category = Category::where('id', $request['id'])->first();
        $category->name = $request['name'];
        $category->parent_id = 0;
        $category->company_id = $company_id;
        $category->branch_id = $branch_id;
        $category->logo = $img;
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

    public static function decodeBase64Img($request)
    {
        $img_info = $request;
        if (preg_match('/^data:image\/(\w+);base64,/', $img_info, $type)) {

            $img_info = substr($img_info, strpos($img_info, ',') + 1);

            $type = strtolower($type[1]); // jpg, png, jpeg

            if (!in_array($type, ['jpg', 'jpeg', 'png'])) return ['success' => false, 'message' => 'Invalid image type.', 'name' => null];

            $img_info = str_replace(' ', '+', $img_info);

            $image = base64_decode($img_info);
            if ($image === false)
                return [
                    'success' => false,
                    'message' => 'Base64 decode failed.',
                    'name' => null
                ];

            $image_name = time() . "-" . uniqid() . "." . $type;

            if (request()->has('is_test') && request()->is_test)
                file_put_contents(public_path('upload/test_images/') . $image_name, $image);
            else
                file_put_contents(public_path('upload/category/') . $image_name, $image);

            return $image_name;

        } else {
            return [
                'success' => false,
                'message' => 'Did not match data URI with image data.',
                'name' => null
            ];
        }
    }

}
