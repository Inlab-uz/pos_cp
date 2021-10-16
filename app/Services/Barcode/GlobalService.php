<?php

namespace App\Services\Barcode;

class GlobalService
{


    public function search($barcode)
    {


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
        if ($response == null) {
            return false;
        } else {
            return [
                "title" => $response["products"][0]["title"],
                "brand" => $response["products"][0]["brand"],
                "images" => $response["products"][0]["images"],

            ];
        }


    }
}
