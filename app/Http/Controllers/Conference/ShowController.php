<?php

namespace App\Http\Controllers\Conference;

use App\Http\Controllers\Controller;
use App\Http\Resources\Conference\ConferenceResource;
use App\Models\Conference;

class ShowController extends Controller
{
    public function __invoke(Conference $conference)
    {
        return new ConferenceResource($conference);
    }
}
