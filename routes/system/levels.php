<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Level\LevelController;

Route::group(['prefix' => 'system'], function () {
    Route::get('/levels', [LevelController::class, 'index', 'middleware' => ['permission:levels-list|levels-edit']])->name('levels.list');
    Route::post('/levels/save', [LevelController::class, 'store', 'middleware' => ['permission:levels-list|levels-save']])->name('levels.save');
    Route::get('/levels/edit/{id}', [LevelController::class, 'edit', 'middleware' => ['permission:levels-list|levels-save']])->name('levels.edit');
    Route::post('/levels/update', [LevelController::class, 'update', 'middleware' => ['permission:levels-edit']])->name('levels.update');
    Route::post('/levels/delete', [LevelController::class, 'destroy', 'middleware' => ['permission:levels-delete']])->name('levels.destroy');
});
