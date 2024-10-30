<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\clintResource;
use App\Models\Client;
use Illuminate\Http\Request;

class ClintController extends Controller
{
    public function index()
    {
        $clints = Client::with('media')->get();
        $resource = clintResource::collection($clints);
        return response()->json($resource);
    }

    //show
    public function show($id)
    {
        $clint = Client::findOrFail($id);
        $resource = new clintResource($clint);
        return response()->json($resource);
    }
}
