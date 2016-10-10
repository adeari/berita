<?php namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Auth;
use App\User;
use DB;
use URL;

use App\tables\TbKomentar;
use App\tables\TbLokasi;
use App\tables\TbBerita;

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
  public function commonactionn() {
      if (Auth::check()) {
	User::where('id', '=', Auth::user()->id)->update(['lastlogin' => DB::raw('NOW()')]);
      }
  }
  public function gantipassword($request) {
    User::where('id', '=', Auth::user()->id)->update([
      'realpassword' => $request->passwordchange
	,'password' => bcrypt($request->passwordchange)
      ]);
  }
  public function editprofile($request) {
    User::where('id', '=', Auth::user()->id)->update([
      'name' => $request->name
      ,'nik' => $request->nik
      ,'gambar' => $request->gambar
      ,'email' => $request->email
    ]);
  }
  public function deleteberita($request) {
    $berita = TbBerita::find($request->id);
    $komentars = TbKomentar::select('id')->where('idberita', '=', $berita->id)->whereNotNull('gambar')->get();
    foreach ($komentars as  $komentar) {
      $this->komentar1deleted($komentar->id);
    }
    TbKomentar::where('idberita', '=', $berita->id)->delete();
    if (!is_null($berita->filename) && !empty($berita->filename) && file_exists('public/image/'.$berita->filename)) {
      unlink('public/image/'.$berita->filename);
    }
    $berita->delete();
  }
  
  public function komentar1deleted($komentarid) {
      $komentar = TbKomentar::find($komentarid);
      if (!is_null($komentar->gambar) && !empty($komentar->gambar) && file_exists('public/image/'.$komentar->gambar)) {
	unlink('public/image/'.$komentar->gambar);
      }
      $komentar->delete();
      return '1';
  }
  public function getkomentardata($canaccess, $idberita) {
    $komentars = [];
    $komentardata = TbKomentar::
    select('tbkomentar.id'
    ,'tbkomentar.komentar'
    ,'tbkomentar.idberita'
    ,'tbkomentar.useridinput'
    ,'tbkomentar.gambar'
    ,'users.name'
    ,'users.gambar as usersgambar'
    )
    ->where('idberita', '=', $idberita)->orderBy('id')->join('users','users.id','=','tbkomentar.useridinput')->get();
    foreach ($komentardata as $komentar) {
      $gambar = $komentar->gambar;
      if (!is_null($gambar)) {
	$gambar = URL::to('public/image/'.$gambar);
      } else {
	$gambar = '';
      }
      
      $isaccess = '0';
      if ($canaccess == '1' && $komentar->useridinput == Auth::user()->id) {
	$isaccess = '1';
      }
      
      $usersgambar = "";
      if (!is_null($komentar->usersgambar) && !empty($komentar->usersgambar)) {
	$usersgambar = URL::to('public/image/'.$komentar->usersgambar);
      }
      
      $komentars[] = ['komentar' => $komentar->komentar, 'gambar' => $gambar,
      'id' => $komentar->id, 'useridinput' => $komentar->useridinput
      ,'idberita' => $komentar->idberita
      ,'name' => $komentar->name
      ,'usersgambar' => $usersgambar
      ,'showhapusbutton' => true
      ,'showlayoutconfirmhapus' => false
      ,'viewkomentar' => true
      ,'vieweditkomentar' => false
      ,'imageberitashow' => false
      ,'saveimagekomentar' => false
      ,'vdelimagebutton' => false
      ,'dohapusgambar' => '0'
      ,'komentaredit' => ''
      , 'isaccess' => $isaccess];
    }
    return $komentars;
  }
}