<?php

namespace App\Http\Controllers;

use App\Http\Resources\GoodResource;
use App\Http\Resources\CategoryCityResource;
use App\Models\Good;
use App\Http\Controllers\CategoryCityController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CategoryPriceController;
use App\Http\Controllers\CategoryRoomController;
use Illuminate\Http\Resources\Json\ResourceCollection;

use App\Models\CategoryCity;


class GoodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): array
    {
        $cats = (new CategoryController)->index();
        $goods = GoodResource::collection(Good::where(['is_published' => true])->get());

        $cities = (new CategoryCityController)->index();
        $prices = (new CategoryPriceController)->index();
        $rooms = (new CategoryRoomController)->index();
 
        return [
            'data' => [
                'categories' => $cats,
                'goods' => $goods,
                'cities' => $cities,
                'prices' => $prices,
                'rooms' => $rooms,               
            ]
        ];
    }

    /**
     * Display latest goods
     */
    public function latest(): ResourceCollection
    {
        return GoodResource::collection(Good::where(['latest' => true])->get());
    }

    /**
     * Display the specified resource.
     */
    public function show( Good $good): GoodResource
    {
        return new GoodResource($good);
    }


}
