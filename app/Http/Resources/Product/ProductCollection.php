<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'name'=>$this->name,
            'totalPrice'=> round($this->price - $this->price * $this->discount / 100,2),
            'rating'=>$this->reviews->count()>0? round($this->reviews->sum('star')/$this->reviews->count(),2):"No rating yet",
            'discount'=>$this->discount,
            'imageUrl'=>$this->imageUrl,
            'href'=>[
                'link'=>route('products.show',$this->id)
            ],
            'category_id'=>$this->category_id

        ];
    }
}
