<?php

namespace App\Http\Resources\Product;
//use App\Http\Resources\Product\ProductResource;

use Illuminate\Http\Resources\Json\Resource;
//use Illuminate\Http\Resources\Json\ProductResource;
class ProductCollection extends ProductResource
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
            'discount'=>$this->discount,
            'totalprice'=>round((1-($this->discount/100))*$this->price,2),
            'rating'=>$this->reviews->count() >0 ? round($this->reviews->sum('star')/$this->reviews->count(),2) : 'No star yet',
            'href'=>[
                'link'=>route('products.show', $this->id)
            ]
        ];
    }
}
