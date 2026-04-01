<?php

namespace App\Http\Controllers;

use App\Models\Event;

class HomeController extends Controller
{
    public function __invoke()
    {
        $upcomingEvents = Event::published()
            ->upcoming()
            ->orderBy('start_date')
            ->take(6)
            ->get();

        return view('home', compact('upcomingEvents'));
    }
}
