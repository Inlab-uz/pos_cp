<?php

namespace App\Services\Barcode;

use App\Models\BarcodeAPI\ProductGlobal;

class GlobalService
{


    public function search($barcode)
    {

        $product = ProductGlobal::where("barcode_number", $barcode)->first();

        if ($product != null) {
            return self::productB($barcode);
        }

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.barcodelookup.com/v3/products?barcode=$barcode&formatted=y&key=9wwmbxlrg5z55sbfnh4n0vdvxvm0ua",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $response = json_decode($response, true);
        if ($response == null) {
            return response()->json(["status" => false]);
        } else {

            $products = $response["products"];
            if (count($products) > 0)
                foreach ($products as $p) {
                    $product = new ProductGlobal();
                    $product->barcode_number = $p["barcode_number"];
                    $product->barcode_formats = $p["barcode_formats"];
                    $product->title = $p["title"];
                    $product->brand = $p["brand"];
                    $product->model = $p["model"];
                    $product->manufacturer = $p["manufacturer"];
                    $product->category = $p["category"];
                    $product->description = $p["description"];
                    $product->images = json_encode($p["images"]);
                    $product->ingredients = $p["ingredients"];
                    $product->age_group = $p["age_group"];
                    $product->nutrition_facts = $p["nutrition_facts"];
                    $product->energy_efficiency_class = $p["energy_efficiency_class"];
                    $product->color = $p["color"];
                    $product->gender = $p["gender"];
                    $product->material = $p["material"];
                    $product->pattern = $p["pattern"];
                    $product->format = $p["format"];
                    $product->multipack = $p["multipack"];
                    $product->size = $p["size"];
                    $product->length = $p["length"];
                    $product->width = $p["width"];
                    $product->height = $p["height"];
                    $product->weight = $p["weight"];
                    $product->save();
                }

        }
        return self::productB($barcode);


    }

    static function productB($barcode)
    {
        $products = ProductGlobal::where("barcode_number", $barcode)->get();
        return response()->json(["products" => $products]);
    }
}
