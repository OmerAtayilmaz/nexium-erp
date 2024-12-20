<?php

namespace App\Http\Resources;

use App\Models\PageCategory;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PageResource extends JsonResource
{
    public static $wrap = 'page';

    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'type' => 'page',
            'id' => $this->id,
            'attributes' => [
                'title' => $this->title,
                'slug' => $this->slug,
                'featured_image' => $this->featured_image,
                
                'content' => $this->when(
                    $request->routeIs('wcms.page.show'),
                    $this->content
                ),
                'keywords' => $this->when(
                    $request->routeIs('wcms.page.show'),
                    $this->keywords
                ),
                'description' => $this->when(
                    $request->routeIs("wcms.page.show"),
                    $this->description
                ),

                $this->mergeWhen($request->routeIs('wcms.page.index'),[
                    'created_at' => $this->created_at,
                    'updated_at' => $this->updated_at
                ])
               
            ],
            'relationships' => [
                'page-category' => [
                    'type' => "PageCategory",
                    'id' => $this->category_id,
                    'attributes' => $this->category
                ]
                
                    ],
            'links' => [
                [
                    'self' => route('wcms.page.show',['id' => $this->id])
                ]
            ]
        
        ];
    }
}
