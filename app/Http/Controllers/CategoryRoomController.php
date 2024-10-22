<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryRoomResource;
use App\Models\CategoryRoom;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CategoryRoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): ResourceCollection
    {
        return CategoryRoomResource::collection(CategoryRoom::all());
    }

    /**
     * Display the specified resource.
     */
    public function show(CategoryRoom $catroom): CategoryRoomResource
    {
        return new CategoryRoomResource($catroom);
    }
}
