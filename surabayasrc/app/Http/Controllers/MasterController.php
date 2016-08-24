<?php namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;

class MasterController extends BaseController
{
	public function generateRandomString($length = 10) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyz';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}
	public  function setlinestring($str) {
		if (strlen($str) > 0) {
			$str = str_replace("'", "\\'", $str);
		}
		return $str;
	}
	
	public function removeUnusedCharacter($str) {
		if (strlen($str) > 0) {
			$str = str_replace(PHP_EOL, '', $str);
			$str = str_replace('\n', '', $str);
			$str = str_replace(chr(10), '', $str);
			$str = str_replace(chr(13), '', $str);
		}
		return $str;
	}
}