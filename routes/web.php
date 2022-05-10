<?php

use App\Http\Controllers\Admin\NotificationController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UsersController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Route::resource('/admin/users', UsersController::class);

Route::prefix('/admin')->name('admin.')->middleware(['auth','can:admin'])->group(function() {
    Route::prefix('notifications')->name('notification.')->group(function(){
        Route::get('store',[NotificationController::class,'store'])->name('store');
        Route::get('/',[NotificationController::class,'index'])->name('index');
    });

    Route::resource('users', UsersController::class);
});

