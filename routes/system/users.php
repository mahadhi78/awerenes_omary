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

Route::post('/staff/updatePhoto', [UserController::class, 'updatePhoto'])->name('staffs.updatePhoto');


Route::post('/staff/activation', [UserController::class, 'activation', 'middleware' => ['permission:staffs-activation']])->name('staffs.activation');

// start register leaners

Route::post('/learners/store', [LeanerController::class, 'registerStore'])->name('learners.register');
// end register leaners
Route::group(['prefix' => 'system'], function () {
    Route::post('/staff/store', [UserController::class, 'store', 'middleware' => ['permission:staffs-save']])->name('staffs.store');
    Route::get('/staff/registration', [UserController::class, 'create'])->name('staffs.create');

    Route::get('/staff/index', [UserController::class, 'index', 'middleware' => ['permission:staffs-list|staffs-save|staffs-edit|staffs-activation']])->name('staffs.list');

    Route::post('/staff/update', [UserController::class, 'update', 'middleware' => ['permission:staffs-edit']])->name('staffs.update');


    // user approval
    Route::get('/staff/approval', [UserApprovalController::class, 'index', 'middleware' => ['permission:staffs_approval-list"|staffs_approval-edit']])->name('staffs_approval.list');
    Route::post('/staff/approval', [UserApprovalController::class, 'update', 'middleware' => ['permission:staffs_approval-edit']])->name('staffs_approval.edit');

    
    Route::post('/learners/store', [LeanerController::class, 'store'])->name('learners.store');
    Route::get('/learners/registration', [LeanerController::class, 'create'])->name('learners.create');

    Route::get('/learners/index', [LeanerController::class, 'index'])->name('learners.list');

    Route::post('/learners/update', [LeanerController::class, 'update'])->name('learners.update');
});
