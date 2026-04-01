<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function index()
    {
        return view('calendar.index');
    }

    public function events(Request $request)
    {
        $events = Event::published()
            ->when($request->start, fn ($q, $start) => $q->where('start_date', '>=', $start))
            ->when($request->end, fn ($q, $end) => $q->where('start_date', '<=', $end))
            ->get()
            ->map(fn (Event $event) => [
                'id' => $event->id,
                'title' => $event->title,
                'start' => $event->start_date->toIso8601String(),
                'end' => $event->end_date?->toIso8601String(),
                'url' => route('events.show', $event),
                'color' => $event->isFree() ? '#22c55e' : '#3b82f6',
            ]);

        return response()->json($events);
    }
}
