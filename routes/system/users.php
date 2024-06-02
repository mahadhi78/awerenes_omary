<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Leaner\LeanerController;
use App\Http\Controllers\UserManagement\UserController;
use App\Http\Controllers\approval\UserApprovalController;
use App\Http\Controllers\UserManagement\ProfileController;
use App\Http\Controllers\input\controller\StaffInputController;

Route::get('/profile/index', [ProfileController::class, 'index'])->name('profile.index');

Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

Route::post('/profile/updateAdmin', [ProfileController::class, 'updateAdmin'])->name('profile.updateAdmin');

Route::post('/profile/updateFlight', [ProfileController::class, 'updateFlight'])->name('profile.updateFlight');

Route::post('/profile/update-password', [ProfileController::class, 'updatePassword'])->name('profile.updatePassword');
Route::get('/profile/change-password', [ProfileController::class, 'changePassword'])->name('profile.changePassword');

Route::get('/staff/edit/{id}', [UserController::class, 'edit'])->name('staffs.edit');

Route::get('/learners/edit/{id}', [LeanerController::class, 'edit'])->name('learners.edit');

Route::post('/staff/updatePhoto', [UserController::class, 'updatePhoto'])->name('staffs.updatePhoto');


Route::post('/staff/activation', [UserController::class, 'activation', 'middleware' => ['permission:staffs-activation']])->name('staffs.activation');

Route::group(['prefix' => 'system'], function () {
    Route::post('/staff/store', [UserController::class, 'store', 'middleware' => ['permission:staffs-save']])->name('staffs.store');
    Route::get('/staff/registration', [UserController::class, 'create'])->name('staffs.create');

    Route::get('/staff/index', [UserController::class, 'index', 'middleware' => ['permission:staffs-list|staffs-save|staffs-edit|staffs-activation']])->name('staffs.list');

    Route::post('/staff/update', [UserController::class, 'update', 'middleware' => ['permission:staffs-edit']])->name('staffs.update');
    Route::post('/staff/delete', [UserController::class, 'destroy', 'middleware' => ['permission:staffs-delete']])->name('staffs.destroy');


    // user approval
    Route::get('/users/approval', [UserApprovalController::class, 'index'])->name('user_approval.list');
    Route::post('/users/approval', [UserApprovalController::class, 'update'])->name('user_approval.edit');




    Route::get('/learners/index', [LeanerController::class, 'index'])->name('learners.list');
    Route::post('/learners/store', [LeanerController::class, 'store'])->name('learners.store');
    Route::get('/learners/registration', [LeanerController::class, 'create'])->name('learners.create');
    Route::post('/learners/update', [LeanerController::class, 'update'])->name('learners.update');
    Route::post('/learners/delete', [LeanerController::class, 'destroy'])->name('learners.destroy');
});
