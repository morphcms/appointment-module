<?php


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::put('/meetings/{meeting:id}/cancel', [\Modules\Appointment\Actions\CancelMeeting::class, 'execute']);
Route::get('/meetings', \Modules\Appointment\Http\Controllers\Meetings\IndexController::class);
Route::get('/meetings/{meeting:id}', \Modules\Appointment\Http\Controllers\Meetings\ShowController::class);
Route::post('/meetings', \Modules\Appointment\Http\Controllers\Meetings\StoreController::class);
Route::put('/meetings/{meeting:id}', \Modules\Appointment\Http\Controllers\Meetings\UpdateController::class);
Route::put('/meetings/{meeting:id}', [\Modules\Appointment\Actions\RescheduleMeeting::class, 'execute']);
