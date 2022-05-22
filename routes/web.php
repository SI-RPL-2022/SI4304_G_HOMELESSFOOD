<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontpageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomelessController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\DriverController;


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

Route::get('/', [FrontpageController::class, 'index']);
Route::get('/dashboard', [FrontpageController::class, 'dashboard'])->name('dashboard');

Route::prefix('region')->name('region')->group(function () {
    Route::get('dis', [RegionController::class, 'getDis']);
    Route::get('subdis', [RegionController::class, 'getSubdis']);
});

Route::prefix('profile')->name('profile')->group(function () {
    Route::get('', [FrontpageController::class, 'profile']);

    Route::post('change_bio', [ProfileController::class, 'changeBio']);
    Route::post('change_password', [ProfileController::class, 'changePassword']);
});

Route::prefix('homeless')->name('homeless')->group(function () {
    Route::get('', [HomelessController::class, 'index']);
    Route::get('add', [HomelessController::class, 'add']);
    Route::get('edit/{id}', [HomelessController::class, 'edit']);

    Route::post('insert', [HomelessController::class, 'insert']);
    Route::post('update/{id}', [HomelessController::class, 'update']);
    Route::get('delete/{id}', [HomelessController::class, 'delete']);
    Route::get('by_id', [HomelessController::class, 'getById']);
});

Route::prefix('food')->name('food')->group(function () {
    Route::get('', [FoodController::class, 'index']);
    Route::get('add', [FoodController::class, 'add']);
    Route::get('edit/{id}', [FoodController::class, 'edit']);

    Route::post('insert', [FoodController::class, 'insert']);
    Route::post('update/{id}', [FoodController::class, 'update']);
    Route::get('delete/{id}', [FoodController::class, 'delete']);
});

Route::prefix('transaction')
    ->name('transaction')
    ->group(function () {
        Route::get('', [TransactionController::class, 'index']);
        Route::get('add', [TransactionController::class, 'add']);
        Route::get('detail/{id}', [TransactionController::class, 'detail']);

        Route::post('insert', [TransactionController::class, 'insert']);
        Route::post('upload_payment/{id}', [TransactionController::class, 'uploadPayment']);
        Route::get('validation_payment/{id}/{status}', [TransactionController::class, 'validationPayment']);
        Route::post('select_driver/{id}', [TransactionController::class, 'selectDriver']);
    });


Route::prefix('auth')->name('auth')->group(function () {
    Route::get('login', [FrontpageController::class, 'login']);
    Route::get('register', [FrontpageController::class, 'register']);

    Route::post('do_login', [FrontpageController::class, 'do_login']);
    Route::post('do_register', [FrontpageController::class, 'do_register']);
    Route::get('do_logout', [FrontpageController::class, 'do_logout']);
});

Route::prefix('driver')->name('history')->group(function () {
    Route::get('detail/{id}', [DriverController::class, 'detail']);
    Route::get('history', [DriverController::class, 'history']);
    Route::get('history/{id}', [DriverController::class, 'historyDetail']);
    Route::get('complete_order/{id}', [DriverController::class, 'completeOrder']);

    Route::get('add', [DriverController::class, 'add']);
    Route::get('edit/{id}', [DriverController::class, 'edit']);

    Route::post('insert', [DriverController::class, 'insert']);
    Route::post('update/{id}', [DriverController::class, 'update']);
    Route::get('delete/{id}', [DriverController::class, 'delete']);
});


