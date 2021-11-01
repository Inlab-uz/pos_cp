<?php


namespace App\Services;


use App\Models\Branch;
use App\Models\Company;
use App\Models\Import;
use App\Models\Meneger;
use App\Models\ProductLocal;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Product
{
    public static function productCreate($request = [])
    {
        $p = ProductLocal::where('barcode_number', $request['barcode_number'])->first();
        if (!$p){
            ProductLocal::create([

                'barcode_number' => $request['barcode_number'],
                'title' => $request['title'],
                'barcode_formats' => $request['barcode_formats']??"",
                'brand' => $request['brand']??"",
                'model' => $request['model']??"",
                'manufacturer' => $request['manufacturer']??"",
                'category' => $request['category']??"",
                'description' => $request['description']??"",
                'images' => $request['images']??"",
                'ingredients' => $request['ingredients']??"",
                'age_group' => $request['age_group']??"",
                'nutrition_facts' => $request['nutrition_facts']??"",
                'energy_efficiency_class' => $request['energy_efficiency_class']??"",
                'color' => $request['color']??"",
                'gender' => $request['gender']??"",
                'format' => $request['format']??"",
                'multipack' => $request['multipack']??"",
                'size' => $request['size']??"",
                'length' => $request['length']??"",
                'width' => $request['width']??"",
                'height' => $request['height']??"",
                'weight' => $request['weight']??"",
            ]);
        }

        $product = \App\Models\Product::updateOrCreate(
            [
                'barcode_number' => $request['barcode_number'],
                'category_id' => $request['category_id']
            ],
            [
                'title' => $request['title']??"",
                'status' => '1',
                'barcode_formats' => $request['barcode_formats']??"",
                'brand' => $request['brand']??"",
                'model' => $request['model']??"",
                'manufacturer' => $request['manufacturer']??"",
                'category' => $request['category']??"",
                'description' => $request['description']??"",
                'images' => $request['images']??"",
                'ingredients' => $request['ingredients']??"",
                'age_group' => $request['age_group']??"",
                'nutrition_facts' => $request['nutrition_facts']??"",
                'energy_efficiency_class' => $request['energy_efficiency_class']??"",
                'color' => $request['color']??"",
                'gender' => $request['gender']??"",
                'format' => $request['format']??"",
                'multipack' => $request['multipack']??"",
                'size' => $request['size']??"",
                'length' => $request['length']??"",
                'width' => $request['width']??"",
                'height' => $request['height']??"",
                'weight' => $request['weight']??"",
            ]);
        if ($product instanceof \App\Models\Product) {
            $import = new Import();
            $import->category_id = $product['category_id']??"";
//            $import->company_id = self::company()??"";
//            $import->branch_id = self::branch()??"";
            $import->product_id = $product['id']??"";
            $import->discount = $request['discount']??0;
            $import->measure = $request['measure']??0;
            $import->quantity = $request['quantity']??"";
            $import->part = $request['quantity']??0;
            $import->price = $request['price']??0;
            $import->sale_price = $request['sale_price']??0;
            $import->nds = $request['nds']??"15";
            $import->date_produce = Carbon::now();
            $import->date_expire = Carbon::now();
            $import->save();
            return $import;
        }
        return null;
    }

    //* PRODUCT UPDATE */
    public static function productUpdate($request)
    {
        $product = \App\Models\Product::where('barcode_number', $request['barcode_number'])->first();
        $product->category_id = $request['category_id'];
        $product->title = $request['title'];
        $product->status = '1';
        $product->barcode_formats = $request['barcode_formats'];
        $product->brand = $request['brand'];
        $product->model = $request['model'];
        $product->manufacturer = $request['manufacturer'];
        $product->category = $request['category'];
        $product->description = $request['description'];
        $product->images = $request['images'];
        $product->ingredients = $request['ingredients'];
        $product->age_group = $request['age_group'];
        $product->nutrition_facts = $request['nutrition_facts'];
        $product->energy_efficiency_class = $request['energy_efficiency_class'];
        $product->color = $request['color'];
        $product->gender = $request['gender'];
        $product->format = $request['format'];
        $product->multipack = $request['multipack'];
        $product->size = $request['size'];
        $product->length = $request['length'];
        $product->width = $request['width'];
        $product->height = $request['height'];
        $product->weight = $request['weight'];
        $product->update();


        if ($product instanceof \App\Models\Product) {
            $import = Import::where('product_id', $product['id'])->first();

            $import->category_id = $product['category_id'];
            $import->discount = $request['discount'];
            $import->measure = $request['measure'];
            $import->quantity = $request['part'];
            $import->part = $request['part'];
            $import->price = $request['price'];
            $import->sale_price = $request['sale_price'];
            $import->nds = $request['nds'];
            $import->date_expire = Carbon::now();
            $import->date_produce = Carbon::now();
            $import->update();
            return $import;
        }
        return null;

    }
    public static function company(){
        $manager = Meneger::find(auth()->user()->id);
        return $manager->company_id;
    }
    public static function branch(){
        $manager = Meneger::find(auth()->user()->id);
        return $manager->branch_id;
    }
//    public static function categoryId(){
//        $categories = auth()->user()->categories;
//        foreach ($categories as $category){
//            $category_id = $category['id'];
//            return $category_id;
//        }
//    }

}
