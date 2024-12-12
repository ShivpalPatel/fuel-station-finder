<?php

use App\Http\Controllers\ProfileController;

use App\Http\Controllers\EVStationController;
use App\Http\Controllers\FuelStationController;
use App\Http\Controllers\PaymentController;

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\EVStationAdminController;
use App\Http\Controllers\Admin\CarController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\SlotController;
use App\Http\Controllers\UserEVStationController;
use Spatie\Permission\Models\Role;





Route::get('/', function () {
    return view('welcome');
});

// SuperAdmin Routes
Route::middleware(['auth', 'role:SuperAdmin'])->group(function () {
    Route::get('/admin', function () {
        return view('admin.options');
    })->name('admin.options');
});

// User Routes
Route::middleware(['auth', 'role:user'])->group(function () {
  Route::get('/user', function () {
      return view('Useroptions');
  })->name('options');
});







Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



//------------------------------------------------------------
// user actions


Route::get('/nearby-fuel-stations', [FuelStationController::class, 'showNearbyFuelStations'])->name('findNearbyFuel');


Route::get('/ev-stations', [EVStationController::class, 'index'])->name('ev.stations');
Route::get('/ev-stations/{id}/slots', [EVStationController::class, 'viewSlots'])->name('ev.slots');
Route::post('/slots/{id}/book', [EVStationController::class, 'bookSlot'])->name('slots.book');

Route::post('/payment/process', [PaymentController::class, 'processPayment'])->name('payment.process');
Route::get('/booking/success/{booking}', [PaymentController::class, 'bookingSuccess'])->name('booking.success');


// web.php
Route::get('/payment/success', [PaymentController::class, 'paymentSuccess']);

//===============================================================================
// Admin Dashboard


// EV Stations Management
Route::prefix('admin/ev-stations')->name('admin.ev-stations.')->group(function () {
    Route::get('/', [EVStationAdminController::class, 'index'])->name('index'); // List all EV stations
    Route::get('/create', [EVStationAdminController::class, 'create'])->name('create'); // Show form to create EV station
    Route::post('/', [EVStationAdminController::class, 'store'])->name('store'); // Store new EV station
    Route::get('/{id}/edit', [EVStationAdminController::class, 'edit'])->name('edit'); // Edit EV station
    Route::put('/{id}', [EVStationAdminController::class, 'update'])->name('update'); // Update EV station
    Route::delete('/{id}', [EVStationAdminController::class, 'destroy'])->name('destroy'); // Delete EV station
});

// Cars Management
Route::prefix('admin/cars')->name('admin.cars.')->group(function () {
    Route::get('/', [CarController::class, 'index'])->name('index'); // List all cars
    Route::get('/create', [CarController::class, 'create'])->name('create'); // Show form to create car
    Route::post('/', [CarController::class, 'store'])->name('store'); // Store new car
    Route::get('/{id}/edit', [CarController::class, 'edit'])->name('edit'); // Edit car
    Route::put('/{id}', [CarController::class, 'update'])->name('update'); // Update car
    Route::delete('/{id}', [CarController::class, 'destroy'])->name('destroy'); // Delete car
});

// Users Management
Route::prefix('admin/users')->name('admin.users.')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('index'); // List all users
    Route::get('/create', [UserController::class, 'create'])->name('create'); // Show form to create user
    Route::post('/', [UserController::class, 'store'])->name('store'); // Store new user
    Route::get('/{id}/edit', [UserController::class, 'edit'])->name('edit'); // Edit user
    Route::put('/{id}', [UserController::class, 'update'])->name('update'); // Update user
    Route::delete('/{id}', [UserController::class, 'destroy'])->name('destroy'); // Delete user
});

// Bookings Management
Route::prefix('admin/bookings')->name('admin.bookings.')->group(function () {
    Route::get('/', [BookingController::class, 'index'])->name('index'); // List all bookings
    Route::get('/create', [BookingController::class, 'create'])->name('create'); // Show form to create booking
    Route::post('/', [BookingController::class, 'store'])->name('store'); // Store new booking
    Route::get('/{id}/edit', [BookingController::class, 'edit'])->name('edit'); // Edit booking
    Route::put('/{id}', [BookingController::class, 'update'])->name('update'); // Update booking
    Route::delete('/{id}', [BookingController::class, 'destroy'])->name('destroy'); // Delete booking
});







// user panel route
// User Routes
// Route::get('/profile', [ProfileController::class, 'show'])->name(name: 'profilez');
// Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
// web.php

Route::middleware(['auth'])->group(function () {
    Route::get('/user/bookings', [EVStationController::class, 'userPersonalBookings'])->name('user.bookings');
});
// slots management
Route::prefix('admin/slots')->name('admin.slots.')->group(function () {
    Route::get('/', action: [SlotController::class, 'options'])->name('options');
    Route::get('/index', [SlotController::class, 'index'])->name('index'); // List all bookings

});

// Route for displaying the automatic slot generation form
Route::get('/admin/slots/create-auto', [SlotController::class, 'createAuto'])->name('admin.slots.create.auto');

// Route for generating the slots after preview
Route::post('/admin/slots/generate', [SlotController::class, 'generateSlots'])->name('admin.slots.generate');

// Route to delete old available slots
Route::post('/admin/slots/delete-old', [SlotController::class, 'deleteOldSlots'])->name('admin.slots.delete-old');

Route::delete('/admin/slots/delete/{id}', [SlotController::class,'destroy'])->name('admin.slots.deleteSingle');

require __DIR__.'/auth.php';
