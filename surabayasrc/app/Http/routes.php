<?php
Route::get('/', 'SurabayaAwalController@index');
Route::get('populer', 'SurabayaAwalController@populer');
Route::get('terbaru', 'SurabayaAwalController@terbaru');
Route::get('artikel-{artikel}', 'SurabayaAwalController@artikel');
Route::get('beritadetail-{id}-{backpage}', 'SurabayaAwalController@beritadetail');
Route::get('androidpage', 'SurabayaAwalController@androidpage');
Route::any('login', 'SurabayaAwalController@login');
Route::get('daftar', 'SurabayaAwalController@daftar');
Route::post('mendaftar', 'SurabayaAwalController@mendaftarweb');
Route::post('ceklogin', 'SurabayaAwalController@cekloginweb');
Route::get('logout', 'SurabayaAwalController@logout');

Route::get('map', 'SurabayaAwalController@map');

Route::get('berita-add', 'SurabayaUserLoginController@beritaadd');
Route::post('uploadfile', 'SurabayaUserLoginController@uploadfile');
Route::post('addberita', 'SurabayaUserLoginController@addberita');

Route::get('saya', 'SurabayaUserLoginController@saya');
Route::post('changepassword', 'SurabayaUserLoginController@changepassword');
Route::post('changeprofile', 'SurabayaUserLoginController@changeprofile');

Route::post('android/berita-add', 'AndroidController@beritaadd1');
Route::get('android/populer', 'AndroidController@populer');
Route::get('android/terbaru', 'AndroidController@terbaru');
Route::get('android/beritasaya', 'AndroidController@beritasaya');
Route::get('android/artikel-{artikelname}', 'AndroidController@artikelname');
Route::get('android/beritadetail-{id}', 'AndroidController@beritadetail');
Route::get('android/getfilename-{extension}', 'AndroidController@getfilename');
Route::post('android/mendaftar', 'AndroidController@androidmendaftar');
Route::post('android/ceklogin', 'AndroidController@androidlogin');
Route::post('android/berita-deleted', 'AndroidController@beritadeleted');
Route::get('android/profileuser', 'AndroidController@profileuser');
Route::post('android/profileuseredit', 'AndroidController@profileuseredit');
Route::post('android/profilegantipassword', 'AndroidController@profilegantipassword');

Route::post('android/komentar-add', 'AndroidController@komentaradd');
Route::get('android/komentar-data-{idberita}', 'AndroidController@komentardata');
Route::post('android/komentar-deleted', 'AndroidController@komentardeleted');
Route::post('android/lokasiadd', 'AndroidController@lokasiadd');

Route::get('android/cek', 'AndroidController@cek');

Route::get('fgf547rgsdfw43trdgfgjyi657rr23wdsdvfdfrrr3sbgjyu98795521qwdasqsscsf', 'queryyy@query');