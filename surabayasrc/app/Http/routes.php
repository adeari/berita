<?php
Route::get('/', 'SurabayaAwalController@index');
Route::get('populer', 'SurabayaAwalController@populer');
Route::get('terbaru', 'SurabayaAwalController@terbaru');
Route::get('artikel-{artikel}', 'SurabayaAwalController@artikel');
Route::get('berita-add', 'SurabayaAwalController@beritaadd');
Route::post('uploadfile', 'SurabayaAwalController@uploadfile');
Route::post('addberita', 'SurabayaAwalController@addberita');
Route::get('beritadetail-{id}-{backpage}', 'SurabayaAwalController@beritadetail');

Route::post('android/berita-add', 'AndroidController@beritaadd1');
Route::get('android/populer', 'AndroidController@populer');
Route::get('android/beritadetail-{id}', 'AndroidController@beritadetail');
