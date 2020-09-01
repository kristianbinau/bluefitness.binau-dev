<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/debug-sentry', function () {
    throw new Exception('Sentry Error!');
});

Route::get('/', ScoreboardController::class . '@index')->name('Home');

Route::prefix('admin')->name('Admin')->group(
    function () {
        Route::get('/', AdminController::class . '@index')->name('Home');

        Route::prefix('record')->name('Record')->group(
            function () {
                Route::get('/', AdminController::class . '@record')->name('Home');
                Route::post('/', AdminController::class . '@storeRecord')->name('Store');
                Route::get('/delete/{id}', \Api\AdminApiController::class . '@deleteRecord')->name('Delete');
            }
        );

        Route::prefix('user')->name('User')->group(
            function () {
                Route::get('/', AdminController::class . '@user')->name('Home');
                Route::post('/', AdminController::class . '@storeUser')->name('Store');
                Route::get('/delete/{id}', \Api\AdminApiController::class . '@deleteUser')->name('Delete');
            }
        );

        Route::prefix('class')->name('Class')->group(
            function () {
                Route::get('/', AdminController::class . '@class')->name('Home');
                Route::post('/', AdminController::class . '@storeClass')->name('Store');
                Route::get('/delete/{id}', \Api\AdminApiController::class . '@deleteClass')->name('Delete');
            }
        );

        Route::prefix('exercise')->name('Exercise')->group(
            function () {
                Route::get('/', AdminController::class . '@exercise')->name('Home');
                Route::post('/', AdminController::class . '@storeExercise')->name('Store');
                Route::get('/delete/{id}', \Api\AdminApiController::class . '@deleteExercise')->name('Delete');
            }
        );
    }
);




