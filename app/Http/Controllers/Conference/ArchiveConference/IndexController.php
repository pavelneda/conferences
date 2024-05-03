<?php

namespace App\Http\Controllers\Conference\ArchiveConference;

use App\Http\Controllers\Controller;
use App\Http\Requests\Conference\IndexRequest;
use App\Http\Resources\Conference\ConferenceResource;
use App\Models\Conference;
use Carbon\Carbon;

class IndexController extends Controller
{
    public function __invoke(IndexRequest $request)
    {

        if ($request->input('count')) {
            $archive_conferences = Conference::where('date', '<', Carbon::now()->timestamp  * 1000)->orderBy('date', 'desc')->limit($request->input('count'))->get();
        }else{
            $archive_conferences = Conference::where('date', '<', Carbon::now()->timestamp  * 1000)->orderBy('date', 'desc')->get();
        }

        return ConferenceResource::collection($archive_conferences);
    }
}
