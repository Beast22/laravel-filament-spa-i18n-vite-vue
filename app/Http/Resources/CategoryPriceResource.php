<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;

class CategoryPriceResource extends JsonResource
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
        $PriceData['objectsCount'] = $this->goods()->where(['is_published' => true])->count();

        $media = $this->getMedia();

        if ($media) {
            $PriceData['images'] = [];
            foreach($media as $i) {
                $PriceData['images'] = ["preview" => $i->getUrl('preview'), "large" => $i->getUrl('large')];
            }
        }

        unset(
           $PriceData['created_at'],
           $PriceData['updated_at'],
        );

        return $PriceData;
    }
}
