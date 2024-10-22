<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryPriceResource;
use App\Models\CategoryPrice;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CategoryPriceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): ResourceCollection
    {
        return CategoryPriceResource::collection(CategoryPrice::all());
    }

    /**
     * Display the specified resource.
     */
    public function show( CategoryPrice $catprice): CategoryPriceResource
    {
        return new CategoryPriceResource($catprice);
    }
}
