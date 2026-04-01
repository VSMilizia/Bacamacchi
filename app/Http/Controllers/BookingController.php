<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Event;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function store(Request $request, Event $event)
    {
        $validated = $request->validate([
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        $spots = $event->availableSpots();
        if ($spots !== null && $validated['quantity'] > $spots) {
            return back()->withErrors(['quantity' => 'Posti insufficienti.']);
        }

        $booking = Booking::create([
            'user_id' => $request->user()->id,
            'event_id' => $event->id,
            'quantity' => $validated['quantity'],
            'total_price' => $event->price * $validated['quantity'],
            'status' => $event->isFree() ? 'confirmed' : 'pending',
            'paid_at' => $event->isFree() ? now() : null,
        ]);

        if (! $event->isFree()) {
            return redirect()->route('bookings.payment', $booking);
        }

        return redirect()->route('bookings.confirmation', $booking)
            ->with('success', 'Prenotazione confermata!');
    }

    public function myBookings(Request $request)
    {
        $bookings = $request->user()
            ->bookings()
            ->with('event')
            ->latest()
            ->paginate(10);

        return view('bookings.index', compact('bookings'));
    }

    public function payment(Booking $booking)
    {
        $this->authorizeBooking($booking);

        return view('bookings.payment', compact('booking'));
    }

    public function confirmation(Booking $booking)
    {
        $this->authorizeBooking($booking);

        return view('bookings.confirmation', compact('booking'));
    }

    private function authorizeBooking(Booking $booking): void
    {
        if ($booking->user_id !== auth()->id()) {
            abort(403);
        }
    }
}
