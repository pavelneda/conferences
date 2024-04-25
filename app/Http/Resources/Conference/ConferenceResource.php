<?php

namespace App\Http\Resources\Conference;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ConferenceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'title' => $this->title,
            'id' => $this->id,
            'date' => date('d.m.Y', $this->date / 1000),
            'industry' => $this->industry->title,
            'place' => $this->place,
            'preview_text' => $this->preview_text,
            'description' => $this->description,
            'price' => $this->price,
            'application_deadline' => date('d.m.Y', $this->application_deadline / 1000),
        ];
    }
}
