<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;

class RoomWithGoodsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $RoomData = parent::toArray($request);
        $RoomData['objects'] = GoodResource::collection($this->goods()->where(['is_published' => true])->get());

        unset(
            $RoomData['created_at'],
            $RoomeData['updated_at'],
        );
        
        return  $RoomData;
    }
}
