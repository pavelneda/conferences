<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['namespace' => 'App\\Http\\Controllers\\Conference', 'prefix' => 'conferences'], function () {
    Route::get('/', 'ActualConference\\IndexController')->name('conferences.actual.index');
    Route::get('/archive', 'ArchiveConference\\IndexController')->name('conferences.archive.index');
    Route::get('/{conference}', 'ShowController')->name('conferences.show');

    Route::group(['namespace' => 'Material'], function () {
        Route::get('/{conference}/materials', 'IndexController')->name('conferences.materials.index');
    });
});

Route::group(['namespace' => 'App\\Http\\Controllers\\Industry', 'prefix' => 'industries'], function () {
    Route::get('/', 'IndexController')->name('industries.index');
});

Route::group(['namespace' => 'App\\Http\\Controllers\\Material', 'prefix' => 'materials'], function () {
    Route::get('/', 'IndexController')->name('materials.index');
    Route::get('/{material}', 'ShowController')->name('materials.show');

    Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::post('/', 'StoreController')->name('materials.store');
    });
});

