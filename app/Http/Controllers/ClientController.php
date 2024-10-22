<?php

namespace App\Http\Controllers;

use App\Http\Resources\ClientResource;
use App\Models\Client;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): ResourceCollection
    {
        return ClientResource::collection(Client::all());
    }

    /**
     * Display the specified resource.
     */
    public function show( Client $client): ClientResource
    {
        return new ClientResource($client);
    }
}
