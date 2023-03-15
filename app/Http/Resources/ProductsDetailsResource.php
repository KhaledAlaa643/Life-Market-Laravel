<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Database\Eloquent\Model;

class ProductsDetailsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array

    {

        
       return [
        'id' => $this->id,
        'name' => $this->name,
        'description' => $this->description,
        'price' => $this->price,
        'brand' =>  $this->brand,
        'photo'=>$this->photo,
        // 'category'=> $this->sub_categories,
        // 'delivery_price '=>$this-> 	delivery_price,
        'star' => $this->products_rating,
        'review' => $this->products_rating,
        // 'discount'=>$this->products_discount,
        
       ];
    }
}
