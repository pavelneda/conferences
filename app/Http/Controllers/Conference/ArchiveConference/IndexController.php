<?php

namespace App\Http\Controllers\Conference\ArchiveConference;

use App\Http\Controllers\Controller;
use App\Http\Resources\Conference\ConferenceResource;
use App\Models\Conference;
use Carbon\Carbon;

class IndexController extends Controller
{
    public function __invoke()
    {

        $archive_conferences = Conference::where('date', '<', Carbon::now()->timestamp  * 1000)->get();

        return ConferenceResource::collection($archive_conferences);
    }
}
