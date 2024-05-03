<?php

namespace App\Http\Controllers\Material;

use App\Http\Controllers\Controller;
use App\Http\Resources\Material\MaterialResource;
use App\Models\Material;

class ShowController extends Controller
{
    public function __invoke(Material $material)
    {
        return new MaterialResource($material);
    }
}
