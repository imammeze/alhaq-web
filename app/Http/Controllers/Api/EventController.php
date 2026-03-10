<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Http\Resources\Api\EventResource;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::with('category')
            ->orderBy('event_date', 'asc')
            ->paginate(5);

        return EventResource::collection($events);
    }

    public function show($slug)
    {
        $event = Event::with('category')->where('slug', $slug)->firstOrFail();

        return new EventResource($event);
    }
}