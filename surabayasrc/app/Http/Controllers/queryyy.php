<?php namespace App\Http\Controllers;
use Illuminate\Routing\Controller as BaseController;
use DB;
use File;

class queryyy extends BaseController {
	public function query(){
// 	DB::statement("truncate users;");
//   DB::statement("truncate tbberita;");
//   DB::statement("truncate tbkomentar;");
//    DB::statement("ALTER TABLE `users` ADD `name` VARCHAR(200) NOT NULL AFTER `isadmin`, ADD `gambar` TEXT NOT NULL AFTER `name`;");

DB::statement("CREATE TABLE `tblokasi` (`id` bigint(20) NOT NULL, `userid` bigint(20) NOT NULL, `langitude` varchar(50) NOT NULL, `longitude` varchar(50) NOT NULL,  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00');");
DB::statement("ALTER TABLE `tblokasi`ADD PRIMARY KEY (`id`);");
DB::statement("ALTER TABLE `tblokasi` MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;");
	}
	public function fromfile(){
		DB::statement(File::get('nin.txt'));

	}
}