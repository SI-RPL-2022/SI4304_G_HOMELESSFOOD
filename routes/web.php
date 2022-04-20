<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontpageController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\VaccineController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomelessController;
use App\Http\Controllers\RegionController;

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

    Route::post('insert', [HomelessController::class, 'insert']);
    Route::get('delete/{id}', [HomelessController::class, 'delete']);
});

Route::prefix('auth')->name('auth')->group(function () {
    Route::get('login', [FrontpageController::class, 'login']);
    Route::get('register', [FrontpageController::class, 'register']);

    Route::post('do_login', [FrontpageController::class, 'do_login']);
    Route::post('do_register', [FrontpageController::class, 'do_register']);
    Route::get('do_logout', [FrontpageController::class, 'do_logout']);
});


