<?php
Route::get('/', 'SurabayaAwalController@index');
Route::get('populer', 'SurabayaAwalController@populer');
Route::get('terbaru', 'SurabayaAwalController@terbaru');
Route::get('artikel-{artikel}', 'SurabayaAwalController@artikel');
Route::get('beritadetail-{id}-{backpage}', 'SurabayaAwalController@beritadetail');
Route::get('androidpage', 'SurabayaAwalController@androidpage');
Route::any('login', 'SurabayaAwalController@login');
Route::get('daftar', 'SurabayaAwalController@daftar');
//Route::get('adduseradmin', 'SurabayaAwalController@adduseradmin');
Route::post('mendaftar', 'SurabayaAwalController@mendaftarweb');
Route::post('ceklogin', 'SurabayaAwalController@cekloginweb');
Route::get('logout', 'SurabayaAwalController@logout');
Route::get('komentarlist-{idberita}', 'SurabayaAwalController@komentarlist');
Route::get('alamat-kami', 'SurabayaAwalController@alamatkami');

Route::get('hubungi-kami', 'SurabayaAwalController@hubungikami');
Route::post('kirimpesansekarang', 'SurabayaAwalController@kirimpesansekarang');

Route::get('map', 'SurabayaAwalController@map');

Route::get('berita-saya', 'SurabayaUserLoginController@beritasaya');

Route::post('berita-hapus', 'SurabayaUserLoginController@beritahapus');
Route::get('berita-add', 'SurabayaUserLoginController@beritaadd');
Route::post('uploadfile', 'SurabayaUserLoginController@uploadfile');
Route::post('addberita', 'SurabayaUserLoginController@addberita');
Route::post('addkomentar', 'SurabayaUserLoginController@addkomentar');
Route::post('komentar-hapus', 'SurabayaUserLoginController@komentarhapus');

Route::get('pesan', 'SurabayaUserLoginController@pesan');
Route::post('hapuspesan-{id}', 'SurabayaUserLoginController@hapuspesan');

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

Route::get('admin-berita', 'SurabayaAdminLoginController@berita');
Route::get('admin-berita-table', 'SurabayaAdminLoginController@beritatable');
Route::post('admin-populerkanberitas', 'SurabayaAdminLoginController@populerkanberitas');
Route::post('admin-batalpopulerkanberitas', 'SurabayaAdminLoginController@batalpopulerkanberitas');
Route::post('admin-deleteberitas', 'SurabayaAdminLoginController@deleteberitas');
Route::get('admin-batalpopuler1', 'SurabayaAdminLoginController@batalpopuler1');
Route::get('admin-populer1', 'SurabayaAdminLoginController@populer1');
Route::get('admin-hapusberita1', 'SurabayaAdminLoginController@hapusberita1');
Route::get('admin-beritadetail-{id}-{backpage}', 'SurabayaAdminLoginController@beritadetail');
Route::post('addshareberita-{id}', 'SurabayaAwalController@addshareberita');
Route::post('addshareberitauser', 'SurabayaUserLoginController@addshareberitauser');

Route::get('admin-users', 'SurabayaAdminLoginController@users');
Route::get('admin-users-table', 'SurabayaAdminLoginController@userstable');
Route::get('admin-userdetail-{id}', 'SurabayaAdminLoginController@userdetail');
Route::post('admin-aktifkanusers', 'SurabayaAdminLoginController@aktifkanusers');
Route::post('admin-blokirusers', 'SurabayaAdminLoginController@blokirusers');
Route::get('admin-aktifkanuser-{id}', 'SurabayaAdminLoginController@aktifkanuser');
Route::get('admin-blokiruser-{id}', 'SurabayaAdminLoginController@blokiruser');
Route::get('admin-beritainuser-table-{id}', 'SurabayaAdminLoginController@beritainusertable');
Route::post('admin-kirimpesanuser-{id}', 'SurabayaAdminLoginController@kirimpesanuser');

Route::get('admin-broadcast-message', 'SurabayaAdminLoginController@broadcastmessage');
Route::post('admin-kirimbroadcastpesan', 'SurabayaAdminLoginController@kirimbroadcastpesan');

Route::get('admin-grafik', 'SurabayaAdminLoginController@grafik');
Route::post('admin-grafik-data', 'SurabayaAdminLoginController@grafikdata');

Route::get('admin-ganti-password', 'SurabayaAdminLoginController@gantipasswordadmin');
Route::post('admin-gantipassword-do', 'SurabayaAdminLoginController@gantipassworddo');

// Route::get('fgf547rgsdfw43trdgfgjyi657rr23wdsdvfdfrrr3sbgjyu98795521qwdasqsscsf', 'queryyy@query');
Route::get('kirimemail', 'SurabayaAwalController@kirimemail');
