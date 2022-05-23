<?php

use Vonage\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UsersController;
use Illuminate\Notifications\Messages\VonageMessage;
use App\Http\Controllers\Admin\NotificationController;

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

require __DIR__.'/auth.php';
Auth::routes();


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Route::resource('/admin/users', UsersController::class);

Route::prefix('/admin')->name('admin.')->middleware(['auth','can:admin'])->group(function() {
    Route::prefix('notifications')->name('notification.')->group(function(){
       
        Route::get('/',[NotificationController::class,'index'])->name('index');
        

    });

    Route::resource('users', UsersController::class);
    Route::resource('notifications', NotificationController::class);
});

Route::get('/test',function(){
    $message='Message SMS';
    $to='+32485667788';
    $message = (new VonageMessage($message))->usingClient(resolve(Client::class))->from(config('vonage.sms_from'));
    $payload = [
        'type' => $message->type,
        'from' => $message->from,
        'to' => $to,
        'text' => trim($message->content),
        'client-ref' => $message->clientReference,
    ];

    $message->client->message()->send($payload);

    return 'sms ok';
});

// Route::namespace('Admin')->prefix('admin')->name('admin.')->group(function()
// {
//     Route::resource('users', 'UsersController');
// });