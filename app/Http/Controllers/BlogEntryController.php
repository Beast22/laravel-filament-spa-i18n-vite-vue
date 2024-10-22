<?php

namespace App\Http\Controllers;

use App\Http\Resources\BlogEntryResource;
use App\Models\BlogEntry;
use Illuminate\Http\Resources\Json\ResourceCollection;

class BlogEntryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): ResourceCollection
    {
        return BlogEntryResource::collection(BlogEntry::where(['is_published' => true])->get());
    }

    /**
     * Display the specified resource.
     */
    public function show( BlogEntry $blogentry): BlogEntryResource
    {
        return new BlogEntryResource($blogentry);
    }
}
