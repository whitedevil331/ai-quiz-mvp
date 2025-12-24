<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuizController;

Route::get('/', [QuizController::class, 'index']);
Route::post('/generate', [QuizController::class, 'generate']);
Route::post('/submit', [QuizController::class, 'submit']);

