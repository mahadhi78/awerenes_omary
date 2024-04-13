<?php

use App\Http\Controllers\setting\SettingController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'system'], function () {
    Route::get('/settings', [SettingController::class, 'index', 'middleware' => ['permission:settings-list|settings-edit']])->name('settings.list');
    Route::put('/settings/update', [SettingController::class, 'update', 'middleware' => ['permission:settings-edit']])->name('settings.update');
});
