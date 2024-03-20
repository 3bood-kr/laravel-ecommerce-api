<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReviewResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'userId' => $this->user_id,
            'productId' => $this->product_id,
            'rating' => $this->rating,
            'comment' => $this->comment,
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at
        ];
    }
}
