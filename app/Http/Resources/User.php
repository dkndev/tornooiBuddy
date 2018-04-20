<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class User extends JsonResource
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
            'gender'  => $this->gender,
            'age'  => $this->age,
            'location' => [
                'postcode' => $this->location->postcode,
                'latitude' => $this->location->latitude,
                'longitude' => $this->location->longitude,
            ],
            'rankings' => [
                'single'  => $this->singleRank->rank,
                'dubble'  => $this->dubbleRank->rank,
                'mix'  => $this->mixRank->rank,
            ],
        ];
    }
}
