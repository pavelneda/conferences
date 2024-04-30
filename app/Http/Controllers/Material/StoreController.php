<?php

namespace App\Http\Controllers\Material;

use App\Http\Controllers\Controller;
use App\Http\Requests\Material\StoreRequest;
use App\Models\Conference;
use App\Models\Material;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();

        $file = $data['file'];
        unset($data['file']);

        $fileName = md5(Carbon::now() . '_' . $file->getClientOriginalName()) . '.' . $file->getClientOriginalExtension();
        $filePath = Storage::disk('public')->putFileAs('/materials', $file, $fileName);

        $data['path'] = $filePath;
        $data['url'] = url('/storage/' . $filePath);


        Material::create($data);


        return response(['message' => 'ok']);
    }
}
