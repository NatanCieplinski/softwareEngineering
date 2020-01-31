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
Route::post('utenti/register', 'UserController@register');
Route::post('utenti/login', 'UserController@login');

Route::group(['middleware' => ['auth:api']], function () {
	Route::get('utenti/', 'UserController@all');
	Route::post('utenti/new', 'UserController@create');
	Route::get('utenti/logout', 'UserController@logout');

	Route::get('utenti/{id}', 'UserController@show');
	Route::post('utenti/{id}', 'UserController@update');
	Route::delete('utenti/{id}', 'UserController@destroy');
	Route::get('utenti/{id}/ban', 'UserController@ban');
	Route::get('utenti/{id}/prenotazioni', 'UserController@reservations');
});

/**
 * Routes /api/banchi
 */
Route::group(['middleware' => ['auth:api']], function () {
	Route::get('banchi/{id}/', 'DeskController@show');
	Route::post('banchi/{id}/', 'DeskController@update');
	Route::delete('banchi/{id}/', 'DeskController@destroy');
	
	Route::get('banchi', 'DeskController@all');
	Route::get('banchi/aula/{id}', 'DeskController@byClassroom');
	Route::post('banchi/new', 'DeskController@create');
});

/**
 * Routes /api/aule
 */
Route::group(['middleware' => ['auth:api']], function () {
	Route::get('aule/{id}', 'ClassroomController@show');
	Route::post('aule/{id}', 'ClassroomController@update');
	Route::delete('aule/{id}', 'ClassroomController@destroy');

	Route::get('aule', 'ClassroomController@all');
	Route::post('aule/new', 'ClassroomController@create');
});

/**
 * Routes /api/mappe
 */
Route::group(['middleware' => ['auth:api']], function () {
	Route::get('mappe/{id}', 'MapController@show');
	Route::post('mappe/{id}', 'MapController@update');
	Route::delete('mappe/{id}', 'MapController@destroy');
	Route::post('mappe/{id}/upload', 'MapController@upload');
	Route::post('mappe/{id}/download', 'MapController@download');

	Route::get('mappe', 'MapController@all');
	Route::post('mappe/new', 'MapController@create');
});

/**
 * Routes /api/tipibanco
 */
Route::group(['middleware' => ['auth:api']], function () {
	Route::get('tipibanco/{id}', 'DesktypeController@show');
	Route::post('tipibanco/{id}', 'DesktypeController@update');
	Route::delete('tipibanco/{id}', 'DesktypeController@destroy');
	
	Route::get('tipibanco', 'DesktypeController@all');
	Route::post('tipibanco/new', 'DesktypeController@create');
});

/**
 * Routes /api/configurazioni
 */
Route::group(['middleware' => ['auth:api']], function () {
	Route::get('configurazioni/{id}', 'ConfigurationController@show');
	Route::post('configurazioni/{id}', 'ConfigurationController@update');
	Route::delete('configurazioni/{id}', 'ConfigurationController@destroy');

	Route::get('configurazioni', 'ConfigurationController@all');
	Route::post('configurazioni/new', 'ConfigurationController@create');
});

/**
 * Routes /api/segnalazioni
 */
Route::group(['middleware' => ['auth:api']], function () {
	Route::get('segnalazioni/{id}', 'ReportController@show');
	Route::post('segnalazioni/{id}', 'ReportController@update');
	Route::delete('segnalazioni/{id}', 'ReportController@destroy');

	Route::get('segnalazioni/utente/{id}', 'ReportController@byUser');
	Route::post('segnalazioni/new', 'ReportController@create');
});

/**
 * Routes /api/prenotazioni
 */
Route::group(['middleware' => ['auth:api']], function () {
	Route::delete('prenotazioni/{id}', 'ReservationController@destroy');
	Route::post('prenotazioni/{id}/checkin', 'ReservationController@checkin');
	Route::post('prenotazioni/{id}/pausa', 'ReservationController@pause');

	Route::post('prenotazioni/new', 'ReservationController@create');
	Route::post('prenotazioni/aula/{id}', 'ReservationController@byClassroom');
	Route::get('prenotazioni/utente/{id}', 'ReservationController@byUser');
});

/**
 * Routes /api/schedules
 */
Route::group(['middleware' => ['auth:api']], function () {
	Route::delete('schedules/{id}', 'ScheduleController@destroy');

	Route::post('schedules/new', 'ScheduleController@create');
	Route::get('schedules/utente/{id}', 'ScheduleController@byUser');
	Route::get('schedules/aula/{id}', 'ScheduleController@byClassroom');
});

/**
 * Routes /api/chisure
 */
Route::group(['middleware' => ['auth:api']], function () {
	Route::delete('chisure/{id}', 'ClosingController@destroy');

	Route::post('chisure/new', 'ClosingController@create');
	Route::get('chisure/aula/{id}', 'ClosingController@byClassroom');
});