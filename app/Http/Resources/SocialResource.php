<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SocialResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $socialData = parent::toArray($request);

        $media = $this->getMedia('socials');

        if($media){
            $socialData['icon'] = [];

            foreach($media as $m) {
                $socialData['icon']= $m->getUrl();
            }
        }

        unset(
            $socialData['created_at'],
            $socialData['updated_at'],
        );

        return $socialData;
    }
}
