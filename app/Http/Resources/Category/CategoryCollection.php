<?php

namespace App\Http\Resources\Category;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryCollection extends JsonResource
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
            'slug'=>$this->slug,
            'imageUrl'=>$this->imageUrl,
            'status'=>$this->status,
            'href'=>[
                'link'=>route('category.show',$this->id)
            ],

        ];
    }
}
