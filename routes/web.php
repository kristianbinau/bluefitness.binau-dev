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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::prefix('admin')->name('Admin')->group(
    function () {
        Route::get('/', AdminController::class . '@index')->name('Home');
        // Render in view
        Route::prefix('record')->name('Record')->group(
            function () {
                Route::get('/', AdminController::class . '@record')->name('Home');
                Route::post('/', AdminController::class . '@storeRecord')->name('Store');
            }
        );
        Route::prefix('user')->name('User')->group(
            function () {
                Route::get('/', AdminController::class . '@user')->name('Home');
                Route::post('/', AdminController::class . '@storeUser')->name('Store');
            }
        );
        Route::prefix('class')->name('Class')->group(
            function () {
                Route::get('/', AdminController::class . '@class')->name('Home');
                Route::post('/', AdminController::class . '@storeClass')->name('Store');
            }
        );
        Route::prefix('exercise')->name('Exercise')->group(
            function () {
                Route::get('/', AdminController::class . '@exercise')->name('Home');
                Route::post('/', AdminController::class . '@storeExercise')->name('Store');
            }
        );
    }
);




