<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;

class BlogEntryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $blogData = parent::toArray($request);

        $media = $this->getMedia('blog');

        if ($media) {
            $blogData['images'] = [];
            foreach($media as $i) {
                $blogData['images'] = ["preview" => $i->getUrl('preview'), "large" => $i->getUrl('large')];
            }
        }

        unset(
            $blogData['updated_at'],

        );

        return $blogData;

    }
}
