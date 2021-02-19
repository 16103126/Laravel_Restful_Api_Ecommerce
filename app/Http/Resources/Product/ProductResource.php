<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'user_id'=>$this->user_id,
            'name'=>$this->name,
            'description'=>$this->details,
            'price'=>$this->price,
            'discount'=>$this->discount,
            'totalprice'=>round((1-($this->discount/100))*$this->price,2),
            'rating'=>$this->reviews->count() >0 ? round($this->reviews->sum('star')/$this->reviews->count(),2) : 'No star yet',
            'stock'=>$this->stock==0 ? 'out of stock': $this->stock,

            'href'=>[
                'reviews'=> route('reviews.index', $this->id)
            ]
        ];
    }
}
