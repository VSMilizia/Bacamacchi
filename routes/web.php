<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\EventController as AdminEventController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', HomeController::class)->name('home');
Route::get('/eventi', [EventController::class, 'index'])->name('events.index');
Route::get('/eventi/{event:slug}', [EventController::class, 'show'])->name('events.show');
Route::get('/calendario', [CalendarController::class, 'index'])->name('calendar');
Route::get('/api/calendar-events', [CalendarController::class, 'events'])->name('calendar.events');

// Authenticated user routes
Route::middleware('auth')->group(function () {
    Route::post('/eventi/{event}/prenota', [BookingController::class, 'store'])->name('bookings.store');
    Route::get('/prenotazioni', [BookingController::class, 'myBookings'])->name('bookings.index');
    Route::get('/prenotazioni/{booking}/pagamento', [BookingController::class, 'payment'])->name('bookings.payment');
    Route::get('/prenotazioni/{booking}/conferma', [BookingController::class, 'confirmation'])->name('bookings.confirmation');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', AdminDashboardController::class)->name('dashboard');
    Route::resource('events', AdminEventController::class);
    Route::get('events/{event}/bookings', [AdminEventController::class, 'bookings'])->name('events.bookings');
});

require __DIR__.'/auth.php';
