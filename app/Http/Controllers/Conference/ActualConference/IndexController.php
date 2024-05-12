<?php

namespace App\Http\Controllers\Conference\ActualConference;

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
            $actual_conferences = Conference::where('date', '>=', Carbon::now())->orderBy('date', 'asc')->limit($request->input('count'))->get();
        } else {
            $actual_conferences = Conference::where('date', '>=', Carbon::now())->orderBy('date', 'asc')->get();
        }

        return ConferenceResource::collection($actual_conferences);
    }
}
