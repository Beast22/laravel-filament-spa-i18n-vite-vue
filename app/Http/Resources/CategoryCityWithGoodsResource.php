<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryCityWithGoodsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        $CityData = parent::toArray($request);
        $CityData['objects'] = GoodResource::collection($this->goods()->where(['is_published' => true])->get());

        unset(
            $CityData['created_at'],
            $CityData['updated_at'],
        );
        
        return  $CityData;
    }
}
