<?php


use App\Http\Controllers\UserManagement\RoleController;
use Illuminate\Support\Facades\Route;

Route::get('roles/{id}/show', [RoleController::class, 'show'])->name('roles.show');

Route::get('roles/{id}/edit', [RoleController::class, 'edit'])->name('roles.edit');

Route::group(['prefix' => 'system'], function () {

    Route::get('/roles', [RoleController::class, 'index', 'middleware' => ['permission:roles-list|roles-save|roles-edit|roles-delete']])->name('roles.index');
    Route::get('/roles/create', [RoleController::class, 'create', 'middleware' => ['permission:roles-list|roles-save']])->name('roles.save');

    Route::post('/roles/store', [RoleController::class, 'store', 'middleware' => ['permission:roles-save']])->name('roles.store');

    Route::post('/roles/destroy', [RoleController::class, 'destroy', 'middleware' => ['permission:roles-delete']])->name('roles.destroy');

    Route::post('/roles/update/{id}', [RoleController::class, 'update', 'middleware' => ['permission:roles-edit']])->name('roles.update');
});
