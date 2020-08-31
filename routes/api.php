<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('admin')->name('Admin')->group(
    function () {

        Route::prefix('record')->name('Record')->group(
            function () {
            }
        );

        Route::prefix('user')->name('User')->group(
            function () {
            }
        );

        Route::prefix('class')->name('Class')->group(
            function () {

            }
        );

        Route::prefix('exercise')->name('Exercise')->group(
            function () {
                Route::get('/delete/{id}', \Api\AdminApiController::class . '@deleteExercise')->name('Delete');
            }
        );
    }
);
