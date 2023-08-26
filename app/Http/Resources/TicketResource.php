<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TicketResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'ticket_no' => $this->ticket_no,
            'passenger_id' => $this->passenger_id,
            'passenger_name' => $this->passenger_name,
            'contact_data' => $this->contact_data ? json_decode($this->contact_data) : null,
            'booking' => new BookingResource($this->booking),
        ];
    }
}
