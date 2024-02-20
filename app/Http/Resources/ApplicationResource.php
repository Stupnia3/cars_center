<?php

namespace App\Http\Resources;

use App\Enums\StatusEnum;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ApplicationResource extends JsonResource
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
            'car_number' => $this->car_number,
            'description' => $this->description,
            'status' => $this->status,
            'user' => [
                'id' => $this->user->id,
                'full_name' => $this->user->full_name,
            ],
        ];
    }
}
