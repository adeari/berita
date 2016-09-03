<?php
Route::get('/', 'SurabayaAwalController@index');
Route::get('populer', 'SurabayaAwalController@populer');
Route::get('terbaru', 'SurabayaAwalController@terbaru');
Route::get('artikel-{artikel}', 'SurabayaAwalController@artikel');
Route::get('berita-add', 'SurabayaAwalController@beritaadd');
Route::post('uploadfile', 'SurabayaAwalController@uploadfile');
Route::post('addberita', 'SurabayaAwalController@addberita');
Route::get('beritadetail-{id}-{backpage}', 'SurabayaAwalController@beritadetail');
Route::get('androidpage', 'SurabayaAwalController@androidpage');
Route::any('login', 'SurabayaAwalController@login');
Route::get('daftar', 'SurabayaAwalController@daftar');
Route::post('mendaftar', 'SurabayaAwalController@mendaftarweb');
Route::post('ceklogin', 'SurabayaAwalController@cekloginweb');
Route::get('logout', 'SurabayaAwalController@logout');

Route::post('android/berita-add', 'AndroidController@beritaadd1');
Route::get('android/populer', 'AndroidController@populer');
Route::get('android/beritadetail-{id}', 'AndroidController@beritadetail');
Route::get('android/getfilename-{extension}', 'AndroidController@getfilename');
Route::post('android/mendaftar', 'AndroidController@androidmendaftar');
Route::post('android/ceklogin', 'AndroidController@androidlogin');