<?php

namespace App\Http\Controllers\Admin\Conference;

use App\Http\Controllers\Controller;
use App\Http\Resources\Conference\ConferenceResource;
use App\Models\Conference;


class IndexController extends Controller
{
    public function __invoke()
    {
        $conferences = Conference::all();
        return ConferenceResource::collection($conferences);
    }
}
