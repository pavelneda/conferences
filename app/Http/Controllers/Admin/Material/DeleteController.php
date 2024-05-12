<?php

namespace App\Http\Controllers\Admin\Material;

use App\Http\Controllers\Controller;
use App\Models\Material;
use Illuminate\Support\Facades\Storage;


class DeleteController extends Controller
{
    public function __invoke(Material $material)
    {
        Storage::disk('public')->delete($material->path);
        $material->delete();

        return response(['message' => 'ok']);
    }
}
