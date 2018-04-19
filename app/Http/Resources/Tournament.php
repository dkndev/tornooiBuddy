<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Tournament extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'location' => [
                'address' => $this->location->address,
                'latitude' => $this->location->latitude,
                'longitude' => $this->location->longitude,
            ],
            'date' => [
                'start' => $this->date_start,
                'end' => $this->date_end,
            ],
            'contact' => $this->contact->name,
        ];
    }
}
