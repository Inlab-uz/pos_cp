<?php

namespace App\Imports;

use App\Models\Company;
use App\Models\Import;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ImportProducts implements ToModel, WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $company = Company::where('user_id', auth()->user()->id)->first();
        $product = Product::create([
            'category_id'     => $row[1],
            'company_id'     => $company->id,
            'title'     => $row[2],
            'barcode_number'    => 0,
        ]);
        $import = Import::create([
            'category_id'     => $row[1],
            'product_id'     => $product->id,
            'price'     => $row[3],
            'sale_price'     => $row[4],
            'measure'    => 0,
            'quantity'    => $row[5],
            'part'    => $row[5],
            'nds'    => $row[6],
            'discount'    => $row[7],
        ]);
        return $product;
    }

    public function startRow(): int
    {
        return 2;
    }
}
