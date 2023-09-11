<?php

use App\Http\Controllers\PlayController;
use Illuminate\Support\Facades\Route;

Route::get('/play/{id}.mp3', [PlayController::class, 'index'],);
