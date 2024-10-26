<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{

    public static $wrap = 'user';
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
       return [
        'type' => 'user',
        'id' => $this->id,
        'attributes' => [
            'name' => $this->name,
            'email' => $this->email,
            $this->mergeWhen($request->routeIs('users.show'),[
                'emailVerifiedAt' => $this->email_verified_at,
                'createdAt' => $this->created_at,
                'updatedAt' => $this->updated_at
            ])
        ]
       ];
    }
}
