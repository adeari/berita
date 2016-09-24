<?php namespace App\Http\Controllers;
use Illuminate\Routing\Controller as BaseController;
use DB;
use File;

class queryyy extends BaseController {
	public function query(){
	DB::statement("truncate users;");
  DB::statement("truncate tbberita;");
  DB::statement("truncate tbkomentar;");
//    DB::statement("ALTER TABLE `users` ADD `name` VARCHAR(200) NOT NULL AFTER `isadmin`, ADD `gambar` TEXT NOT NULL AFTER `name`;");
	}
	public function fromfile(){
		DB::statement(File::get('nin.txt'));

	}
}