<?php

namespace App\Http\Controllers;

use App\Http\Resources\ServiceItemResource;
use App\Models\ServiceItem;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ServiceItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): ResourceCollection
    {
        return ServiceItemResource::collection(ServiceItem::all());
    }

    /**
     * Display the specified resource.
     */
    public function show( ServiceItem $service): CategoryPriceResource
    {
        return new CategoryPriceResource($service);
    }
}
