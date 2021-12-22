<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductExcelResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'price' => $this->import['price'],
            'sale_price' => $this->import['sale_price'],
            'quantity' => $this->import['quantity'],
            'part' => $this->import['part'],
            'nds' => $this->import['nds'],
            'discount' => $this->import['discount'],
        ];
    }
}
