<?php

namespace App\Http\Controllers\Industry;

use App\Http\Controllers\Controller;
use App\Http\Resources\Industry\IndustryResource;
use App\Models\Industry;

class IndexController extends Controller
{
    public function __invoke()
    {

        $industries = Industry::all();

        return IndustryResource::collection($industries);
    }
}
