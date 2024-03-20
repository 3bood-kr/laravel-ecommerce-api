<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'parentCategory' => new CategoryResource($this->parentCategory),
            'slug' => $this->slug,
            'description' => $this->description,
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updatedAt,
        ];
    }
}
