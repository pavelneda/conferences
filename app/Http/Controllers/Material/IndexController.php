<?php

namespace App\Http\Controllers\Material;

use App\Http\Controllers\Controller;
use App\Http\Requests\Material\IndexRequest;
use App\Http\Resources\Material\MaterialResource;
use App\Models\Material;
use Illuminate\Http\Request;


class IndexController extends Controller
{
    public function __invoke(IndexRequest $request)
    {
        if ($request->input('count')) {
            $materials = Material::where('confirmed', 1)->orderBy('created_at', 'desc')->limit($request->input('count'))->get();
        }else{
            $materials = Material::where('confirmed', 1)->orderBy('created_at', 'desc')->get();
        }

        return MaterialResource::collection($materials);
    }
}
