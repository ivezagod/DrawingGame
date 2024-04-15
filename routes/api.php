<?php

use App\Http\Controllers\DrawingCoordinatesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/drawing-coordinates', [DrawingCoordinatesController::class, 'store'])->name('drawing-coordinates.store');
