<?php

namespace App\Http\Controllers;

use App\Http\Resources\FooterMenuResource;
use App\Models\FooterMenu;
use Illuminate\Http\Resources\Json\ResourceCollection;

class FooterMenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): ResourceCollection
    {
        return FooterMenuResource::collection(FooterMenu::all());
    }

    /**
     * Display the specified resource.
     */
    public function show(FooterMenu $fmenu): FooterMenuResource
    {
        return new FooterMenuResource($fmenu);
    }
}
