<?php namespace App\Http\Controllers;

use App\Http\Controllers\MasterController;
use Illuminate\Http\Request;
use App\tables\TbBerita;
use URL;
use Auth;
use Mail;
use DB;
use App\User;
use App\tables\TbLokasi;
use App\tables\TbKomentar;

class SurabayaAwalController extends MasterController
{
    public function index() {
      if (Auth::check()) {
	if (auth::user()->isadmin) {
	  return redirect('admin-grafik');
	}
      }
    	return redirect('populer');
    }
    public function populer() {
    	$beritas = '';
    	$databeritas = TbBerita::where('populer', '=', true)->orderBy('updated_at', 'desc')->get();
    	$folderimage = 'public/image';
    	foreach ($databeritas as $databerita) {
    		$filename = $databerita->filename;
    		if (!is_null($filename)) {
    			$pathfilename =  $folderimage.'/'.$filename;
    			$filename = URL::to($pathfilename);
    		}
    		if (strlen($beritas) > 0) {
    			$beritas .= ',';
    		}
    		$tanggal = substr($databerita->updated_at, 8, 2).'/'.substr($databerita->updated_at, 5, 2).'/'.substr($databerita->updated_at, 0, 4).substr($databerita->updated_at, 10, 6);
    		$beritas .= '{id:'.$databerita->id.', filename:\''.$filename.'\', judul:\''.$this->setlinestring($databerita->judul).'\', deskripsi: \''.$this->setlinestring($databerita->deskripsi).'\'
    				,tanggal:\''.$tanggal.'\'}';
    	}
    	return view('populer', [
    			'beritas' => $beritas
    			, 'backpage' => 'populer'
    	]);
    }
    public function terbaru() {
    	$beritas = '';
    	$databeritas = TbBerita::orderBy('updated_at', 'desc')->get();
    	$folderimage = 'public/image';
    	foreach ($databeritas as $databerita) {
    		$filename = $databerita->filename;
    		if (!is_null($filename)) {
    			$pathfilename =  $folderimage.'/'.$filename;
    			$filename = URL::to($pathfilename);
    		}
    		if (strlen($beritas) > 0) {
    			$beritas .= ',';
    		}
    		$tanggal = substr($databerita->updated_at, 8, 2).'/'.substr($databerita->updated_at, 5, 2).'/'.substr($databerita->updated_at, 0, 4).substr($databerita->updated_at, 10, 6);
    		$beritas .= '{id:'.$databerita->id.', filename:\''.$filename.'\', judul:\''.$this->setlinestring($databerita->judul).'\', deskripsi: \''.$this->setlinestring($databerita->deskripsi).'\'
    				,tanggal:\''.$tanggal.'\'}';
    	}
    	return view('terbaru', [
    			'beritas' => $beritas
    			, 'backpage' => 'terbaru'
    	]);
    }
    public function artikel($artikel) {
    	$beritas = '';
    	$databeritas = TbBerita::where('kategori', '=',  $artikel)->orderBy('updated_at', 'desc')->get();
    	$folderimage = 'public/image';
    	foreach ($databeritas as $databerita) {
    		$filename = $databerita->filename;
    		if (!is_null($filename)) {
    			$pathfilename =  $folderimage.'/'.$filename;
    			$filename = URL::to($pathfilename);
    		}
    		if (strlen($beritas) > 0) {
    			$beritas .= ',';
    		}
    		$tanggal = substr($databerita->updated_at, 8, 2).'/'.substr($databerita->updated_at, 5, 2).'/'.substr($databerita->updated_at, 0, 4).substr($databerita->updated_at, 10, 6);
    		$beritas .= '{id:'.$databerita->id.', filename:\''.$filename.'\', judul:\''.$this->setlinestring($databerita->judul).'\', deskripsi: \''.$this->setlinestring($databerita->deskripsi).'\'
    				,tanggal:\''.$tanggal.'\'}';
    	}
    	return view('artikel', [
    			'beritas' => $beritas
    			, 'artikel' => ucfirst($artikel)
    			, 'backpage' => $artikel
    	]);
    }

    public function login(Request $request) {
      $variable['viewdaftar'] = true;
      if (isset($request->loginonly)) {
	$variable['viewdaftar'] = false;
      }
      return view('login', $variable);
    }

    public function beritadetail($id, $backpage = '', Request $request) {
		return view('beritadetail', $this->parameterdetail($id, $backpage, $request));
	}

  public function mendaftarweb(Request $request) {
	  return $this->mendaftar($request);
	}
  public function cekloginweb(Request $request) {
    $msg = ['success' => 0, 'msg' => 'Tidak sesuai'];
    $canlogin = 0;
    if (Auth::attempt(array('username' => $request->usernamenik, 'password' => $request->password))) {
      $canlogin = 1;
    } else if (Auth::attempt(array('nik' => $request->usernamenik, 'password' => $request->password))) {
      $canlogin = 1;
    }
    if ($canlogin == 1) {
      if (Auth::user()->aktif) {
        $msg = ['success' => 1, 'msg' => ''];
      } else {
        $msg['msg'] = 'User Di Blokir';
      }
    }
    return $msg;
  }
  public function logout() {
    Auth::logout();
    return redirect('/');
  }
  public function daftar() {
    return view('daftar');
  }
  public function androidpage() {
	  return view('androidpage');
	}
  public function map(){
    $tblokasi = TbLokasi::join('users', 'users.id', '=', 'tblokasi.userid')->get();
    return view('map', ['datamaps' => $tblokasi]);
  }
  public function komentarlist($idberita, Request $request) {
    $canaccess = 0;
    if (Auth::check()) {
      $canaccess = 1;
    }
    return $this->getkomentardata($canaccess, $idberita);
  }
  public function adduseradmin() {
    $user = User::create([
	      'username' => 'admin',
	      'name' => 'Admin',
	      'nik' => '0',
	      'password' => bcrypt('asdf1234'),
	      'email' => 'cek@yaya.com',
	      'realpassword' => 'asdf1234',
	      'aktif' => 1,
	    ]);
    User::where('id','=', $user->id)->update([
      'isadmin' => true
    ]);
    return 'waaaa';
  }
  public function kirimemail() {
    @Mail::send('emailku', ['pesan' => 'ada pesannnya'], function ($message) {
        $message->from('cs@surabayadigitalcity.net', 'Customer Service');
        $message->to('ade_ari_w0@yahoo.com')->cc('adeariw84@gmail.com');
        $message->subject('adapesan');
    });
  }
  public function addshareberita($id) {
    TbBerita::where('id', '=', $id)->update(['jumlah_share' => DB::raw('jumlah_share + 1')]);
    return 1;
  }
}
