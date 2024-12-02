<?php

use App\Http\Controllers\ProfileController;

use App\Http\Controllers\FuelStationController;
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
Route::get('/nearby-ev-stations', [FuelStationController::class, 'ev'])->name('findNearbyEV');


require __DIR__.'/auth.php';
