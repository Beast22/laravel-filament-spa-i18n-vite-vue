<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryCityResource;
use App\Models\CategoryCity;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CategoryCityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): ResourceCollection
    {
        return CategoryCityResource::collection(CategoryCity::all());
    }

    /**
     * Display the specified resource.
     */
    public function show( CategoryCity $catcity): CategoryCityResource
    {
        return new CategoryCityResource($catcity);
    }
}
