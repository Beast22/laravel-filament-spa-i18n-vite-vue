<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FooterMenuResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $fMenuData = parent::toArray($request);

        unset(
            $fMenuData['created_at'],
            $fMenuData['updated_at'],
         );

         return  $fMenuData;

    }
}
