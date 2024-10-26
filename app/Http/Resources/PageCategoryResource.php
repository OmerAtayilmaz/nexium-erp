<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PageCategoryResource extends JsonResource
{
    public static $wrap = 'page-category';
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'type' => 'page-category',
            'id' => $this->id,
            'attributes' => [
                'title' => $this->title,
                'slug' => $this->slug,
                'description' => $this->description,
                'published_at' => $this->published_at,
                'status' => $this->status,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at
            ],
            'relationships' => [
                'pages' => $this->when(
                    $request->routeIs('wcms.page-category.show'),
                    $this->pages,)
            ]
            ];
    }
}
