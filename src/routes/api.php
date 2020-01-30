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
Route::group([
	'prefix' => 'mappe', 
	'as' => 'mappe.',
	'middleware' => ['auth:api']
], function () {

	Route::group([
		'prefix' => '{id}',
	], function () {
		Route::get('/', 'MapController@show')->name('show');
		Route::patch('/', 'MapController@update')->name('update');
		Route::delete('/', 'MapController@destroy')->name('destroy');
	});

	Route::get('/all', 'MapController@all')->name('all');
	Route::post('/new', 'MapController@create')->name('new');
	Route::post('/login', 'MapController@login')->name('upload');
	Route::post('/logout', 'MapController@logout')->name('download');
});
 */

/**
 * Routes /api/tipiBanco
Route::group([
	'prefix' => 'tipiBanco', 
	'as' => 'tipiBanco.',
	'middleware' => ['auth:api']
], function () {

	Route::group([
		'prefix' => '{id}',
	], function () {
		Route::get('/', 'DesktypeController@show')->name('show');
		Route::patch('/', 'DesktypeController@update')->name('update');
		Route::delete('/', 'DesktypeController@destroy')->name('destroy');
	});

	Route::get('/all', 'DesktypeController@all')->name('all');
	Route::post('/new', 'DesktypeController@create')->name('new');
});
 */

/**
 * Routes /api/configurazioni
Route::group([
	'prefix' => 'configurazioni', 
	'as' => 'configurazioni.',
	'middleware' => ['auth:api']
], function () {

	Route::group([
		'prefix' => '{id}',
	], function () {
		Route::get('/', 'ConfigurationController@show')->name('show');
		Route::patch('/', 'ConfigurationController@update')->name('update');
		Route::delete('/', 'ConfigurationController@destroy')->name('destroy');
	});

	Route::get('/all', 'ConfigurationController@all')->name('all');
	Route::post('/new', 'ConfigurationController@create')->name('new');
});
 */

/**
 * Routes /api/segnalazioni
Route::group([
	'prefix' => 'segnalazioni', 
	'as' => 'segnalazioni.',
	'middleware' => ['auth:api']
], function () {

	Route::group([
		'prefix' => '{id}',
	], function () {
		Route::get('/', 'ReportController@show')->name('show');
		Route::patch('/', 'ReportController@update')->name('update');
		Route::delete('/', 'ReportController@destroy')->name('destroy');
	});

	Route::get('/utenti/{id}', 'ReportController@byUser')->name('byUser');
	Route::post('/new', 'ReportController@create')->name('new');
});
 */

/**
 * Routes /api/prenotazioni
Route::group([
	'prefix' => 'prenotazioni', 
	'as' => 'prenotazioni.',
	'middleware' => ['auth:api']
], function () {

	Route::group([
		'prefix' => '{id}',
	], function () {
		Route::delete('/', 'ReservationController@destroy')->name('destroy');
		Route::post('/checkin', 'ReservationController@checkin')->name('checkin');
		Route::post('/pausa', 'ReservationController@pause')->name('pause');
	});

	Route::post('/new', 'ReservationController@create')->name('new');
	Route::get('/aula/{id}', 'ReservationController@byClassroom')->name('byClassroom');
});
 */

/**
 * Routes /api/schedules
Route::group([
	'prefix' => 'schedules', 
	'as' => 'schedules.',
	'middleware' => ['auth:api']
], function () {

	Route::group([
		'prefix' => '{id}',
	], function () {
		Route::delete('/', 'ScheduleController@destroy')->name('destroy');
	});

	Route::post('/new', 'ScheduleController@create')->name('new');
	Route::get('/utente/{id}', 'ScheduleController@byUser')->name('byUser');
	Route::get('/aula/{id}', 'ScheduleController@byClassroom')->name('byClassroom');
});
 */

/**
 * Routes /api/chisure
Route::group([
	'prefix' => 'chisure', 
	'as' => 'chisure.',
	'middleware' => ['auth:api']
], function () {

	Route::group([
		'prefix' => '{id}',
	], function () {
		Route::delete('/', 'ClosingController@destroy')->name('destroy');
	});

	Route::post('/new', 'ClosingController@create')->name('new');
	Route::get('/aula/{id}', 'ClosingController@byClassroom')->name('byClassroom');
});
 */