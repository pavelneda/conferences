<?php

namespace App\Http\Resources\Material;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MaterialResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'topic' => $this->topic,
            'id' => $this->id,
            'author' => $this->author,
            'university' => $this->university,
            'industry' => $this->industry->title,
            'url' => $this->url,
            'date' => $this->created_at,
        ];
    }
}
