<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id, 
            'title' => $this->title,
            'slug' => $this->slug,
            'category' => $this->whenLoaded('category', fn() => $this->category->name),
            'thumbnail' => $this->thumbnail ? asset('storage/' . $this->thumbnail) : null,
            'description' => $this->description,
            'event_date' => $this->event_date,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'location' => $this->location,
        ];
    }
}