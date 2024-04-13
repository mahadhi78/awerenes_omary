<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Course\LessonController;
use App\Http\Controllers\Course\ModuleController;
use App\Http\Controllers\Course\CourrseController;

Route::group(['prefix' => 'system'], function () {
    Route::get('/course', [CourrseController::class, 'index'])->name('course.list');
    Route::post('/course/save', [CourrseController::class, 'store'])->name('course.save');
    Route::get('/course/edit', [CourrseController::class, 'edit'])->name('course.edit');
    Route::post('/course/update', [CourrseController::class, 'update'])->name('course.update');
    Route::post('/course/delete', [CourrseController::class, 'destroy'])->name('course.destroy');


    /// modules
    Route::get('/module', [ModuleController::class, 'index'])->name('module.list');
    Route::post('/module/save', [ModuleController::class, 'store'])->name('module.save');
    Route::get('/module/edit', [ModuleController::class, 'edit'])->name('module.edit');
    Route::post('/module/update', [ModuleController::class, 'update'])->name('module.update');
    Route::post('/module/delete', [ModuleController::class, 'destroy'])->name('module.destroy');


    /// lessons
    Route::get('/lesson', [LessonController::class, 'index'])->name('lesson.list');
    Route::get('/lesson/create', [LessonController::class, 'create'])->name('lesson.create');
    Route::post('/lesson/save', [LessonController::class, 'store'])->name('lesson.save');
    Route::get('/lesson/edit', [LessonController::class, 'edit'])->name('lesson.edit');
    Route::post('/lesson/update', [LessonController::class, 'update'])->name('lesson.update');
    Route::post('/lesson/delete', [LessonController::class, 'destroy'])->name('lesson.destroy');

});
