<?php

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
Route::get('/legal', function () {
    return view('legal');
});
Route::get('/contact', function () {
    return view('contact');
});
Route::get('/status', function () {
    return view('status');
});

Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    Route::get('/logout', 'Auth\LoginController@logout');

    Route::get('/home', function () {
        return redirect()->route('containers');
    });

    Route::get('/containers', 'ContainerController@index')->name('containers');

    Route::get('/containers/new', 'ContainerController@showCreateForm')->name('containers.new');
    Route::post('/containers/new', 'ContainerController@handleCreateForm');

    Route::get('/containers/{hash}/destroy', 'ContainerController@delete');

    Route::get('/containers/{hash}/terminal', 'ContainerController@terminal')->name('terminal');
    Route::post('/containers/{hash}/terminal', 'ContainerController@terminalSubmit');

    Route::get('/databases', 'ContainerController@databases')->name('databases');

    Route::get('/settings', 'SettingsController@index')->name('settings');
    Route::post('/settings', 'SettingsController@saveBilling')->name('settings.billing.save');

    Route::get('/docs', function () {
        return view('documentation');
    });
});