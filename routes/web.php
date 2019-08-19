<?php

use App\Http\Controllers\Backend\ServerController;

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

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes(['verify' => true]);

Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', 'HomeController@index')
        ->name('dashboard');
    Route::get('profile', 'ProfileController@show')
        ->name('profile.show')->middleware('verified');

    Route::group(['prefix' => 'server'], function () {
        Route::get('index', [ServerController::class, 'index'])
            ->name('server.index');
        Route::get('add', [ServerController::class, 'add'])
            ->name('server.add');
        Route::post('store', [ServerController::class, 'store'])
            ->name('server.store');
        Route::get('{host}', [ServerController::class, 'show'])
            ->name('server.show');
        Route::group(['prefix' => 'checks'], function () {
            Route::get('add/{host}', [ServerController::class, 'addCheck'])
                ->name('server.checks.add');
            Route::post('add/{host}', [ServerController::class, 'storeCheck'])
                ->name('server.checks.store');
        });
    });
});
