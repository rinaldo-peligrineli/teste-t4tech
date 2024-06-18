<?php

namespace App\Http\Resources\Balldontlie;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BalldontliePlayerResource extends JsonResource
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
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'position' => $this->position,
            'height' => $this->height,
            'pweight' => $this->pweight,
            'jersey_number' => $this->jersey_number,
            'college' => $this->college,
            'country' => $this->country,
            'draft_year' => $this->draft_year,
            'draft_round' => $this->round,
            'draft_number' => $this->draft_number,
            'team' => [
                'id' => $this->team_id,
                'conference' => $this->conference,
                'division' => $this->division,
                'city' => $this->city,
                'name' => $this->name,
                'full_name' => $this->full_name,
                'abreviation' => $this->abbreviation,
            ]
        ];
    }
}
