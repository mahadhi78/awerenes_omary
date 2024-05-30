<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Course\CourrseController;

Route::get('/learning/home', [HomeController::class, 'learning'])->name('learning.home');

Route::get('/learning/course',  [CourrseController::class, 'index'])->name('learning.course');

