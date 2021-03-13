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
// define('LOCATE_BASE_URL', 'https://test_eightcig.locateinv.com');
// define('LOCATE_USERNAME', 'yoany@eightcig.com');
// define('LOCATE_PASSWORD', 'Vape1234');

define('LOCATE_BASE_URL', 'https://magma.locateinv.com');
define('LOCATE_USERNAME', 'dashboard@eightcig.com');
define('LOCATE_PASSWORD', 'Vape1234');


Route::get('/', 'ReportController@dashboard');
Route::get('/updatecurrentdata', 'ReportController@updateCurrentData');
Route::get('/getyesterdaydata', 'ReportController@getYesterdayData');

Auth::routes();

Route::get('/home', 'ReportController@dashboard')->name('home');
Route::get('/statistics', 'ReportController@statistics');
