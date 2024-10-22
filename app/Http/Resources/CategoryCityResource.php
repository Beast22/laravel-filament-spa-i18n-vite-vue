<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;

class CategoryCityResource extends JsonResource
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
        $CityData['objectsCount'] = $this->goods()->where(['is_published' => true])->count();

        $media = $this->getMedia();

        if ($media) {
            $CityData['images'] = [];
            foreach($media as $i) {
                $CityData['images'] = ["preview" => $i->getUrl('preview'), "large" => $i->getUrl('large')];
            }
        }

        unset(
            $CityData['created_at'],
            $CityData['updated_at'],
        );

        return $CityData;
    }
}
