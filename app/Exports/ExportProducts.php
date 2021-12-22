<?php

namespace App\Exports;

use App\Http\Resources\Product\ProductExcelResource;
use App\Http\Resources\Product\ProductIndexResource;
use App\Http\Resources\Product\ProductResource;
use App\Models\Import;
use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportProducts implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $product = Product::all();
        $res = ProductExcelResource::collection($product);
        return $res;
    }
    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Price',
            'Sale Price',
            'Quantity',
            'Part',
            'Nds',
            'Discount',
        ];
    }
}
