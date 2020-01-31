<?php

use Illuminate\Http\Request;

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

/**
 * Routes /api/utenti
 */
Route::post('utenti/register', 'UserController@register')->name('register');
Route::post('utenti/login', 'UserController@login')->name('login');

Route::group(['middleware' => ['auth:api']], function () {
	Route::get('utenti/', 'UserController@all')->name('all');
	Route::post('utenti/new', 'UserController@create')->name('new');
	Route::get('utenti/logout', 'UserController@logout')->name('logout');

	Route::get('utenti/{id}', 'UserController@show')->name('show');
	Route::post('utenti/{id}', 'UserController@update')->name('update');
	Route::delete('utenti/{id}', 'UserController@destroy')->name('destroy');
	Route::get('utenti/{id}/ban', 'UserController@ban')->name('ban');
	Route::get('utenti/{id}/prenotazioni', 'UserController@reservations')->name('reservations');
});

/**
 * Routes /api/banchi
 */
Route::group(['middleware' => ['auth:api']], function () {
	Route::get('banchi/{id}/', 'DeskController@show')->name('show');
	Route::post('banchi/{id}/', 'DeskController@update')->name('update');
	Route::delete('banchi/{id}/', 'DeskController@destroy')->name('destroy');
	
	Route::get('banchi', 'DeskController@all')->name('all');
	Route::post('banchi/new', 'DeskController@create')->name('new');
});

/**
 * Routes /api/aule
 */
Route::group(['middleware' => ['auth:api']], function () {
	Route::get('aule/{id}', 'ClassroomController@show')->name('show');
	Route::post('aule/{id}', 'ClassroomController@update')->name('update');
	Route::delete('aule/{id}', 'ClassroomController@destroy')->name('destroy');

	Route::get('aule', 'ClassroomController@all')->name('all');
	Route::post('aule/new', 'ClassroomController@create')->name('new');
});

/**
 * Routes /api/mappe
 */
Route::group(['middleware' => ['auth:api']], function () {
	Route::get('mappe/{id}', 'MapController@show')->name('show');
	Route::post('mappe/{id}', 'MapController@update')->name('update');
	Route::delete('mappe/{id}', 'MapController@destroy')->name('destroy');
	Route::post('mappe/{id}/upload', 'MapController@upload')->name('upload');
	Route::post('mappe/{id}/download', 'MapController@download')->name('download');

	Route::get('mappe', 'MapController@all')->name('all');
	Route::post('mappe/new', 'MapController@create')->name('new');
});

/**
 * Routes /api/tipibanco
 */
Route::group(['middleware' => ['auth:api']], function () {
	Route::get('tipibanco/{id}', 'DesktypeController@show')->name('show');
	Route::post('tipibanco/{id}', 'DesktypeController@update')->name('update');
	Route::delete('tipibanco/{id}', 'DesktypeController@destroy')->name('destroy');
	
	Route::get('tipibanco', 'DesktypeController@all')->name('all');
	Route::post('tipibanco/new', 'DesktypeController@create')->name('new');
});

/**
 * Routes /api/configurazioni
 */
Route::group(['middleware' => ['auth:api']], function () {
	Route::get('configurazioni/{id}', 'ConfigurationController@show')->name('show');
	Route::post('configurazioni/{id}', 'ConfigurationController@update')->name('update');
	Route::delete('configurazioni/{id}', 'ConfigurationController@destroy')->name('destroy');

	Route::get('configurazioni', 'ConfigurationController@all')->name('all');
	Route::post('configurazioni/new', 'ConfigurationController@create')->name('new');
});

/**
 * Routes /api/segnalazioni
 */
Route::group(['middleware' => ['auth:api']], function () {
	Route::get('segnalazioni/{id}', 'ReportController@show')->name('show');
	Route::post('segnalazioni/{id}', 'ReportController@update')->name('update');
	Route::delete('segnalazioni/{id}', 'ReportController@destroy')->name('destroy');

	Route::get('segnalazioni/utente/{id}', 'ReportController@byUser')->name('byUser');
	Route::post('segnalazioni/new', 'ReportController@create')->name('new');
});

/**
 * Routes /api/prenotazioni
 */
Route::group(['middleware' => ['auth:api']], function () {
	Route::delete('prenotazioni/{id}', 'ReservationController@destroy')->name('destroy');
	Route::post('prenotazioni/{id}/checkin', 'ReservationController@checkin')->name('checkin');
	Route::post('prenotazioni/{id}/pausa', 'ReservationController@pause')->name('pause');

	Route::post('prenotazioni/new', 'ReservationController@create')->name('new');
	Route::get('prenotazioni/aula/{id}', 'ReservationController@byClassroom')->name('byClassroom');
});

/**
 * Routes /api/schedules
 */
Route::group(['middleware' => ['auth:api']], function () {
	Route::delete('schedules/{id}', 'ScheduleController@destroy')->name('destroy');

	Route::post('schedules/new', 'ScheduleController@create')->name('new');
	Route::get('schedules/utente/{id}', 'ScheduleController@byUser')->name('byUser');
	Route::get('schedules/aula/{id}', 'ScheduleController@byClassroom')->name('byClassroom');
});

/**
 * Routes /api/chisure
 */
Route::group(['middleware' => ['auth:api']], function () {
	Route::delete('chisure/{id}', 'ClosingController@destroy')->name('destroy');

	Route::post('chisure/new', 'ClosingController@create')->name('new');
	Route::get('chisure/aula/{id}', 'ClosingController@byClassroom')->name('byClassroom');
});