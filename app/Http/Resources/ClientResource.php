<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;


class ClientResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $clientData = parent::toArray($request);

        $mediaClient = $this->getMedia();

        if($mediaClient) {
            $clientData['img'] = '';

            foreach($mediaClient as $m) {
                $clientData['img'] = $m->getUrl('preview');
            }
        }

        unset(
            $clientData['created_at'],
            $clientData['updated_at'],
        );

        return $clientData;
    }
}
