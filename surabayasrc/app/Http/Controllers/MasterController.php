<?php namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Auth;
use App\User;

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
  public function mendaftar(Request $request) {
	  $return = ['success' => 1, 'msg' => '', 'idelement' => ''];
	  
	  if (User::where('username', '=', $request->usernamenik)->count()  > 0) {
	    $return['success'] = 0;
	    $return['idelement'] = 'usernamenik';
	    $return['msg'] = 'Username ini sudah didaftarkan';
	  } else if (User::where('email', '=', $request->email)->count()  > 0) {
	    $return['success'] = 0;
	    $return['idelement'] = 'email';
	    $return['msg'] = 'Email ini sudah didaftarkan';
	  } else if (User::where('nik', '=', $request->usernamenik)->count() > 0) {
	    $return['success'] = 0;
	    $return['idelement'] = 'usernamenik';
	    $return['msg'] = 'NIK ini sudah didaftarkan';
	  } else {
	    User::create([
	      'username' => $request->usernamenik,
	      'name' => $request->usernamenik,
	      'nik' => $request->usernamenik,
	      'password' => bcrypt($request->password),
	      'email' => $request->email,
	      'realpassword' => $request->password,
	    ]);
	  }
	  return $return;
	}
  public function ceklogin(Request $request) {
    if (Auth::attempt(array('username' => $request->usernamenik, 'password' => $request->password))) {
      return 1;
    } else if (Auth::attempt(array('nik' => $request->usernamenik, 'password' => $request->password))) {
      return 1;
    }
    return 0;
  }
}