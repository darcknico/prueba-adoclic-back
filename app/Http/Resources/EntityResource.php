<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EntityResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'api' => $this->api,
            'description' => $this->description,
            'link' => $this->link,

            $this->mergeWhen($this->relationLoaded('category'), [
                'category' => $this->category,
            ]),
        ];
    }
}
