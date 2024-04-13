<?php 

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\frontend\HomeFController;


Route::get('/contact', [HomeFController::class, 'contact'])->name('frontend.contact');
Route::get('/about', [HomeFController::class, 'about'])->name('frontend.about');
Route::get('/courses', [HomeFController::class, 'courses'])->name('frontend.courses');
