<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id, 
            'title' => $this->title,
            'slug' => $this->slug,
            'category' => $this->whenLoaded('category', fn() => $this->category->name),
            'thumbnail' => $this->thumbnail ? asset('storage/' . $this->thumbnail) : null,
            'content' => $this->content,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
        ];
    }
}