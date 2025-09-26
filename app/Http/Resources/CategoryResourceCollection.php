<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CategoryResourceCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'status' => 'success',
            'data' => $this->collection->map(function ($item) {

                return [
                    'name' => $item->name,
                    'slug' => $item->slug,
                    'total_blogs' => $item->blogs->count()
                ];
            }),
            'meta' => [
                'total_category' => $this->resource->total() ?? $this->collection->count()
            ]
        ];
    }
}
