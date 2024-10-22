<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;

class GoodResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $projectData = parent::toArray($request);

        $mediaGood = $this->getMedia('goods');
        if ($mediaGood) {
            $projectData['images'] = [];
            foreach($mediaGood as $m) {
                $projectData['images'][] = ["preview" => $m->getUrl('preview'), "large" => $m->getUrl('large')];
            }
        }

        $floorplant = $this->getMedia('floorplants');
        if ($floorplant) {
            $projectData['floorplants'] = [];
            foreach($floorplant as $f) {
                $projectData['floorplants'][] = ["preview" => $f->getUrl('preview'), "large" => $f->getUrl('large')];
            }
        }

        unset(
            $projectData['created_at'],
            $projectData['updated_at'],
            
        );

        return $projectData;
    }
}
