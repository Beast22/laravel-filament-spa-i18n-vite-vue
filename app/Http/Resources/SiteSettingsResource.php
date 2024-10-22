<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SiteSettingsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $SiteSettingsData = parent::toArray($request);

        unset(
            $SiteSettingsData['created_at'],
            $SiteSettingsData['updated_at'],
        );

        return $SiteSettingsData;
    }
}
