<?php

namespace App\Http\Controllers;

use App\Http\Resources\SocialResource;
use App\Models\Social;
use Illuminate\Http\Resources\Json\ResourceCollection;

class SocialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): ResourceCollection
    {
        return SocialResource::collection(Social::all());
    }

    /**
     * Display the specified resource.
     */
    public function show(Social $social): SocialResource
    {
        return new SocialResource($social);
    }
}
