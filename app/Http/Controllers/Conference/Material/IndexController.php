<?php

namespace App\Http\Controllers\Conference\Material;

use App\Http\Controllers\Controller;
use App\Http\Resources\Material\MaterialResource;
use App\Models\Conference;

class IndexController extends Controller
{
    public function __invoke(Conference $conference)
    {
        $materials = $conference->materials;
        return MaterialResource::collection($materials);
    }
}
