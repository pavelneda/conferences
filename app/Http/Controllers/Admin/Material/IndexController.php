<?php

namespace App\Http\Controllers\Admin\Material;

use App\Http\Controllers\Controller;
use App\Http\Resources\Material\MaterialResource;
use App\Models\Material;


class IndexController extends Controller
{
    public function __invoke()
    {
        $materials = Material::all();
        return MaterialResource::collection($materials);
    }
}
