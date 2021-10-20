<?php


namespace App\Services;


use App\Models\Import;
use App\Models\ProductLocal;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Product
{
    public static function productCreate($request = [])
    {
        ProductLocal::create([
            'barcode_number' => $request['barcode_number'],
            'title' => $request['title'],

            'barcode_formats' => $request['barcode_formats'],
            'brand' => $request['brand'],
            'model' => $request['model'],
            'manufacturer' => $request['manufacturer'],
            'category' => $request['category'],
            'description' => $request['description'],
            'images' => $request['images'],
            'ingredients' => $request['ingredients'],
            'age_group' => $request['age_group'],
            'nutrition_facts' => $request['nutrition_facts'],
            'energy_efficiency_class' => $request['energy_efficiency_class'],
            'color' => $request['color'],
            'gender' => $request['gender'],
            'format' => $request['format'],
            'multipack' => $request['multipack'],
            'size' => $request['size'],
            'length' => $request['length'],
            'width' => $request['width'],
            'height' => $request['height'],
            'weight' => $request['weight'],
        ]);
        $product = \App\Models\Product::updateOrCreate(
            [
                'barcode_number' => $request['barcode_number'],
                'category_id' => $request['category_id']
            ],
            [
                'title' => $request['title'],
                'status' => '1',
                'barcode_formats' => $request['barcode_formats'],
                'brand' => $request['brand'],
                'model' => $request['model'],
                'manufacturer' => $request['manufacturer'],
                'category' => $request['category'],
                'description' => $request['description'],
                'images' => $request['images'],
                'ingredients' => $request['ingredients'],
                'age_group' => $request['age_group'],
                'nutrition_facts' => $request['nutrition_facts'],
                'energy_efficiency_class' => $request['energy_efficiency_class'],
                'color' => $request['color'],
                'gender' => $request['gender'],
                'format' => $request['format'],
                'multipack' => $request['multipack'],
                'size' => $request['size'],
                'length' => $request['length'],
                'width' => $request['width'],
                'height' => $request['height'],
                'weight' => $request['weight'],
            ]);
        if ($product instanceof \App\Models\Product) {
            $import = new Import();
            $import->category_id = $request['category_id'];
            $import->product_id = $product['id'];
            $import->discount_id = $request['discount'];
            $import->measure = $request['measure'];
            $import->quantity = $request['quantity'];
            $import->part = $request['quantity'];
            $import->price = $request['price'];
            $import->sale_price = $request['sale_price'];
            $import->nds = $request['nds'];
            $import->date_produce = Carbon::now();
            $import->date_expire = Carbon::now();
            $import->save();
            return $import;
        }
        return null;
    }

    //* PRODUCT UPDATE */
    public static function productUpdate($request = [])
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

            $import->category_id = $request['category_id'];
            $import->discount_id = $request['discount_id'];
            $import->measure = $request['measure'];
            $import->quantity = $request['quantity'];
            $import->part = $request['quantity'];
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

}
