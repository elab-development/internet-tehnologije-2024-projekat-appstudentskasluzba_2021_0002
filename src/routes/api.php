<?php

use App\Presentation\Http\Controllers\PredmetController;
use App\Presentation\Http\Controllers\StudentController;
use App\Presentation\Http\Controllers\UpisController;
use Illuminate\Support\Facades\Route;

Route::apiResource('studenti', StudentController::class);
Route::apiResource('predmeti', PredmetController::class);
Route::apiResource('upisi', UpisController::class);

