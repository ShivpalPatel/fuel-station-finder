<?php

use App\Http\Controllers\EVStationController;
use App\Http\Controllers\ProfileController;

use App\Http\Controllers\FuelStationController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });


// Route::get('/search-nearby-fuel-stations', [FuelStationController::class, 'searchNearby']);
// Route to display the search page
// Route::get('/search-nearby-fuel-stations', [FuelStationController::class, 'showSearchPage']);

// // Route to fetch nearby stations (API)
// Route::get('/api/nearby-fuel-stations', [FuelStationController::class, 'searchNearby']);

//------------------------------------------------------------
Route::get('/', function () {
    return view('options');
})->name('options');

Route::get('/nearby-fuel-stations', [FuelStationController::class, 'showNearbyFuelStations'])->name('findNearbyFuel');


Route::get('/ev-stations', [EVStationController::class, 'index'])->name('ev.stations');
Route::get('/ev-stations/{id}/slots', [EVStationController::class, 'viewSlots'])->name('ev.slots');
Route::post('/slots/{slot}/book', [EVStationController::class, 'bookSlot'])->name('slots.book');

// Route::post('/slots/{slot}/confirm-payment', [PaymentController::class, 'confirmPayment'])->name('payment.confirm');

// Route to confirm booking and show details
// Route::get('/confirm-booking/{slotId}', [EVStationController::class, 'confirmBooking'])->name('booking.confirm');

// Simulate payment (No Razorpay API)
// Route::post('/simulate-payment/{bookingId}', [PaymentController::class, 'simulatePayment'])->name('payment.simulate');
Route::post('/payment/process', [PaymentController::class, 'processPayment'])->name('payment.process');


require __DIR__.'/auth.php';
