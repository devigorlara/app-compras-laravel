<?php

use Illuminate\Support\Facades\Broadcast;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::group(['middleware' =>['auth:sanctum']], function(){
    //user
    Route::post('/logout' , [AuthController::class, 'logout']);
});