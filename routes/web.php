<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AjaxController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\UserManagement\UserController;
use App\Http\Controllers\LoginHistory\LoginHistoryController;
use App\Http\Controllers\Phishing\PhishingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::fallback(function () {
    return view('404');
});
Route::get('/', [HomeController::class, 'index'])->name('frontend.home');


require __DIR__ . '/activities/path.php';

Route::get('/login', ['as' => 'login', 'uses' => 'App\Http\Controllers\Auth\LoginController@showLoginForm']);
Route::get('/registration', [RegisterController::class, 'create'])->name('registration');
Route::post('/registration/post', [RegisterController::class, 'save'])->name('registration.save');

Auth::routes();
Route::get('register', function () {
    return redirect('login');
});
Route::post('password-resets', [UserController::class, 'resetPassword'])->name('password.resets');
Route::post('password-resets-email', [UserController::class, 'resetPasswordEmail'])->name('password.resets-email');

Route::group(['middleware' => ['auth', 'prevent-back-history']], function () {
    Route::post('/logout', ['as' => 'logout', 'uses' => 'LoginController@logout']);
    Route::post('/logout', [UserController::class, 'logout'])->name('logout');
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    require __DIR__ . '/system/learning.php';

    Route::get('/system/LoginHistory', [LoginHistoryController::class, 'index'])->name('LoginHistory');

    require __DIR__ . '/system/users.php';
    require __DIR__ . '/system/roles.php';
    require __DIR__ . '/system/settings.php';
    require __DIR__ . '/system/levels.php';
    require __DIR__ . '/system/course.php';
    require __DIR__ . '/system/report.php';

    // activities for user with no permissions

    Route::post('/course/get_course', [AjaxController::class, 'get_course'])->name('get_course.list');
    Route::post('/course/get_module', [AjaxController::class, 'get_module'])->name('get_module.list');
});
Route::get('/{template_name}/{template_id}/{info_id}', [PhishingController::class, 'countClicked'])->name('count_phishing');
