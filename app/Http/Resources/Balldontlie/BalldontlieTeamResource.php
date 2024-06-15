<?php

namespace App\Http\Resources\Balldontlie;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BalldontlieTeamResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'conference' => $this->conference,
            'division' => $this->division,
            'city' => $this->city,
            'name' => $this->name,
            'full_name' => $this->full_name,
            'abbreviation' => $this->abbreviation,

        ];
    }
}
