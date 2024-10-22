<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;

class PriceWithGoodsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $PriceData = parent::toArray($request);
        $PriceData['objects'] = GoodResource::collection($this->goods()->where(['is_published' => true])->get());

        unset(
            $PriceData['created_at'],
            $PriceData['updated_at'],
        );
        
        return  $PriceData;
    }
}
