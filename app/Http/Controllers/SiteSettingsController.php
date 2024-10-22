<?php

namespace App\Http\Controllers;

use App\Http\Resources\SiteSettingsResource;
use App\Models\SiteSettings;
use Illuminate\Http\Resources\Json\ResourceCollection;

class SiteSettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): ResourceCollection
    {
        return SiteSettingsResource::collection(SiteSettings::all());
    }

    /**
     * Display the specified resource.
     */
    public function show( SiteSettings $sitesets): SiteSettingsResource
    {
        return new SiteSettingsResource($sitesets);
    }
}
