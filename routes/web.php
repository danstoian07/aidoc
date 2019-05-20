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

Route::get('/', 'DataController@index');


Route::get('/send-code', 'DataController@get');
Route::post('/send-code', 'DataController@savePacient');

Route::get('/enter-code', 'PacientsController@pacient');
Route::get('/get-time/{code}', 'PacientsController@getTime');


Route::post('/learn-data', 'DataController@learn');

Route::post('/send-for-diagnosis', 'DataController@diagnosis');

Route::get('/send-for-diagnosis', 'DataController@diagnosis');

