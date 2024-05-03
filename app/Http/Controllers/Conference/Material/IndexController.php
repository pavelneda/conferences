<?php

namespace App\Http\Controllers\Conference\Material;

use App\Http\Controllers\Controller;
use App\Http\Resources\Material\MaterialResource;
use App\Models\Conference;
use App\Models\Material;

class IndexController extends Controller
{
    public function __invoke(Conference $conference)
    {
        $materials = $conference->materials->filter(function (Material $material) {
            return $material->confirmed;
        });
        return MaterialResource::collection($materials);
    }
}
