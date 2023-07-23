<?php

use App\Http\Controllers\AirportController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AircraftController;
use Symfony\Component\HttpFoundation\Response;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('aircrafts')->group(function () {
    Route::get('/', [AircraftController::class, 'index'])->name('aircrafts.index');
    Route::get('/{aircraft:aircraft_code}', [AircraftController::class, 'show'])
        ->missing(fn() => response()->json(status: Response::HTTP_NOT_FOUND))
        ->name('aircrafts.show');
    Route::post('/', [AircraftController::class, 'store'])->name('aircrafts.store');
    Route::patch('/{aircraft:aircraft_code}', [AircraftController::class, 'update'])
        ->missing(fn() => response()->json(status: Response::HTTP_NOT_FOUND))
        ->name('aircrafts.update');
});

Route::prefix('airports')->group(function () {
    Route::get('/', [AirportController::class, 'index'])->name('airports.index');
    Route::get('/{airport:airport_code}', [AirportController::class, 'show'])
        ->missing(fn() => response()->json(status: Response::HTTP_NOT_FOUND))
        ->name('airports.show');
    Route::post('/', [AirportController::class, 'store'])->name('airports.store');
    Route::patch('/{airport:airport_code}', [AirportController::class, 'update'])
        ->missing(fn() => response()->json(status: Response::HTTP_NOT_FOUND))
        ->name('airports.update');
});

Route::fallback(function () {
    dd(request());
});
