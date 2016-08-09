<?php
Route::get('/', 'SurabayaAwalController@index');
Route::get('berita-add', 'SurabayaAwalController@beritaadd');
Route::post('uploadfile', 'SurabayaAwalController@uploadfile');
Route::post('addberita', 'SurabayaAwalController@addberita');
