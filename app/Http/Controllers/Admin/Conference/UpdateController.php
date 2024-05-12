<?php

namespace App\Http\Controllers\Admin\Conference;

use App\Http\Controllers\Controller;
use App\Http\Requests\Conference\UpdateRequest;
use App\Models\Conference;


class UpdateController extends Controller
{
    public function __invoke(UpdateRequest $request, Conference $conference)
    {
        $data = $request->validated();

        $data['date'] = date('Y-m-d', strtotime($data['date']));
        $data['application_deadline'] = date('Y-m-d', strtotime($data['application_deadline']));

        $conference->update($data);
        return response(['message' => 'ok']);
    }
}
