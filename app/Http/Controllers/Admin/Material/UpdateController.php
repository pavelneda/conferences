<?php

namespace App\Http\Controllers\Admin\Material;

use App\Http\Controllers\Controller;
use App\Http\Requests\Material\UpdateRequest;
use App\Models\Material;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;


class UpdateController extends Controller
{
    public function __invoke(UpdateRequest $request, Material $material)
    {
        $data = $request->validated();

        if (isset($data['file'])) {
            $file = $data['file'];
            unset($data['file']);
            Storage::disk('public')->delete($data['path']);

            $fileName = md5(Carbon::now() . '_' . $file->getClientOriginalName()) . '.' . $file->getClientOriginalExtension();
            $filePath = Storage::disk('public')->putFileAs('/materials', $file, $fileName);

            $data['path'] = $filePath;
            $data['url'] = url('/storage/' . $filePath);
        }


        $material->update($data);
        return response(['message' => 'ok']);
    }
}
