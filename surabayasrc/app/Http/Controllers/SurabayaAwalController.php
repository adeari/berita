<?php namespace App\Http\Controllers;

use App\Http\Controllers\MasterController;
use Illuminate\Http\Request;
use App\tables\TbBerita;
use URL;
use Auth;
use App\User;

class SurabayaAwalController extends MasterController
{
    public function index() {
    	return redirect('populer');
    }
    public function populer() {
    	$beritas = '';
    	$databeritas = TbBerita::orderBy('id', 'desc')->get();
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
    
    public function beritadetail($id, $backpage = '') {
		return view('beritadetail', ['berita' => TbBerita::find($id)
				, 'backpage' => $backpage
		]);
	}
	
  public function mendaftarweb(Request $request) {
	  return $this->mendaftar($request);
	}
  public function cekloginweb(Request $request) {
    return $this->ceklogin($request);
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
}
