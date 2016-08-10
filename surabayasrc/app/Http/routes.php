<?php
Route::get('/', 'SurabayaAwalController@index');
Route::get('populer', 'SurabayaAwalController@populer');
Route::get('terbaru', 'SurabayaAwalController@terbaru');
Route::get('artikel-{artikel}', 'SurabayaAwalController@artikel');
Route::get('berita-add', 'SurabayaAwalController@beritaadd');
Route::post('uploadfile', 'SurabayaAwalController@uploadfile');
Route::post('addberita', 'SurabayaAwalController@addberita');
Route::get('beritadetail-{id}-{backpage}', 'SurabayaAwalController@beritadetail');
