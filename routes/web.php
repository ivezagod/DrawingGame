<?php

use App\Http\Controllers\CanvasImageController;
use App\Http\Controllers\DrawingBoardController;

use App\Http\Controllers\DrawingCoordinatesController;
use Illuminate\Support\Facades\Route;

Route::post('/drawingBoard.store', [DrawingBoardController::class, 'store'])->name('drawingBoard.store');

Route::get('/', [DrawingBoardController::class, 'create'])->name('welcome');




Route::get('/drawing-board/{url}', [DrawingBoardController::class, 'show'])->name('drawingBoard.show');





