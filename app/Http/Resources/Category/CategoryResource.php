<?php

namespace App\Http\Resources\Category;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'name'=>$this->name,
            'imageUrl'=>$this->imageUrl,
            'slug'=>$this->slug,
            'status'=>$this->status,
            'href'=>[
                'products'=>route('products.index',['category_id'=>$this->id])
            ],


        ];
    }
}
