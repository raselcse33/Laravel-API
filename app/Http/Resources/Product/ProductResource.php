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
            'name'=>$this->name,
            'description'=>$this->details,
            'price'=>$this->price,
            'stock'=>$this->stock == 0 ? 'not avaiable' : $this->stock,
            'discount'=>$this->discount,
            'totatPrice' => round((1-($this->discount/100))* $this->price,2),
            'ratting'=>$this->reviews->count() > 0 ? round($this->reviews->sum('star')/$this->reviews->count(),2) :'not reviews',

            'href'=>[
              'reviews'=>route('review.index',$this->id)
            ]
        ];
    }
}
