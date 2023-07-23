<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AirportResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'code' => $this->airport_code,
            'name' => $this->airport_name,
            'city' => $this->city,
            'longitude' => $this->longitude,
            'latitude' => $this->latitude,
            'timezone' => $this->timezone,
        ];
    }
}
