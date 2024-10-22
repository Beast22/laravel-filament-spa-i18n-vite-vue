<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;

class CategoryRoomResource extends JsonResource
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
        $RoomData['objectsCount'] = $this->goods()->where(['is_published' => true])->count();

        $media = $this->getMedia();

        if ($media) {
            $RoomData['images'] = [];
            foreach($media as $i) {
                $RoomData['images'] = ["preview" => $i->getUrl('preview'), "large" => $i->getUrl('large')];
            }
        }

        unset(
           $RoomData['created_at'],
           $RoomData['updated_at'],
        );

        return $RoomData;
    }
}
