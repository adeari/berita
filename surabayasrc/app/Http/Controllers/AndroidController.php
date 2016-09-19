<?php namespace App\Http\Controllers;

use App\Http\Controllers\MasterController;
use Illuminate\Http\Request;
use App\tables\TbBerita;
use URL;
use Auth;
use App\tables\TbKomentar;

class AndroidController extends MasterController
{
  public function beritaadd1(Request $request) {
    if ($this->ceklogin($request) == 1) {
      if (empty($request->idberita)) {
	$tbberita = new TbBerita();
      } else {
	$tbberita = TbBerita::find($request->idberita);
	
	$imagedirectory = 'public/image/';
	if (($request->imageaction == 'hapus' || $request->imageaction == 'ubah') && !is_null($tbberita->filename)
	  && !empty($tbberita->filename) && file_exists($imagedirectory.$tbberita->filename) ) {
	  unlink($imagedirectory.$tbberita->filename);
	}
      }
      
      $tbberita->judul = $this->removeUnusedCharacter($request->input('judul'));
      $tbberita->deskripsi = $this->removeUnusedCharacter($request->input('deskripsi'));
      $tbberita->kategori = $this->removeUnusedCharacter($request->input('kategori'));
      $tbberita->useridinput = Auth::user()->id;
	  if (!empty($request->input('filename'))) {
		  $tbberita->filename = $request->input('filename');
	  } else if (empty($request->imageaction) && empty($request->idberita)) {
	    $tbberita->filename = null;
	  } else if (!empty($request->imageaction) && !empty($request->idberita)
	    && $request->imageaction == 'hapus') {
	    $tbberita->filename = null;
	  }
      
      if (empty($request->idberita)) {
	$tbberita->save();
      } else {
	$tbberita->update();
      }
      return '1';
    }
    return '0';
  }
  public function populer() {
    $datas = [];
    $beritas = TbBerita::orderBy('updated_at', 'desc')->get();
    foreach ($beritas as $berita) {
      $row['id'] = $berita->id;
      $row['judul'] = $berita->judul;
      if (!is_null($berita->filename)) {
	$row['filename'] = URL::to('public/image/'.$berita->filename);
      } else {
	$row['filename'] = '';
      }
      $datas[] = $row;
    }
    return $datas;
  }
  
  public function terbaru() {
    $datas = [];
    $beritas = TbBerita::orderBy('updated_at', 'desc')->get();
    foreach ($beritas as $berita) {
      $row['id'] = $berita->id;
      $row['judul'] = $berita->judul;
      if (!is_null($berita->filename)) {
	$row['filename'] = URL::to('public/image/'.$berita->filename);
      } else {
	$row['filename'] = '';
      }
      $datas[] = $row;
    }
    return $datas;
  }
  
  public function beritadetail($id, Request $request) {
    $berita = TbBerita::find($id);
    $row['id'] = $berita->id;
    $row['judul'] = $berita->judul;
    $row['deskripsi'] = $berita->deskripsi;
    $row['kategori'] = $berita->kategori;
    $row['tanggal'] = substr($berita->updated_at, 8, 2).'/'.substr($berita->updated_at, 5, 2).'/'.substr($berita->updated_at, 0, 4).substr($berita->updated_at, 10, 6);
    if (!is_null($berita->filename)) {
      $row['filename'] = URL::to('public/image/'.$berita->filename);
    } else {
      $row['filename'] = '';
    }    
    $row['komentars'] = $this->komentardata($id, $request);
    return $row;
  }
  public function getfilename($extension, Request $request) {
    if ($this->ceklogin($request) == 1) {
	  $newfilename = "";
	  if ($extension == "jpg" || $extension == "jpeg" || $extension == "png" || $extension == "bmp") {
	  $folderupload = 'public/image/';
	  $newfilename = 'andr_'.$this->generateRandomString(8). '.' . $extension;
	  $filenameExist = true;
	  while ($filenameExist) {
			if (file_exists($folderupload.$newfilename)) {
				$newfilename = 'andr_'.$newfilenamecek.$this->generateRandomString(8). '.' . $extension;
			} else {
				$filenameExist = false;
			}
		}
	  }
	return $newfilename;
    }
    return '0';
  }
  public function androidmendaftar(Request $request) {
    return $this->mendaftar($request);
  }
  public function androidlogin(Request $request) {
    return $this->ceklogin($request);
  }
  
  public function artikelname($artikelname) {
    $datas = [];
    $beritas = TbBerita::where('kategori', '=', $artikelname)->orderBy('updated_at', 'desc')->get();
    foreach ($beritas as $berita) {
      $row['id'] = $berita->id;
      $row['judul'] = $berita->judul;
      if (!is_null($berita->filename)) {
	$row['filename'] = URL::to('public/image/'.$berita->filename);
      } else {
	$row['filename'] = '';
      }
      $datas[] = $row;
    }
    return $datas;
  }
  public function beritasaya(Request $request) {
    if ($this->ceklogin($request) == 1) {
      $datas = [];
    $beritas = TbBerita::where('useridinput', '=', Auth::user()->id)->orderBy('updated_at', 'desc')->get();
    foreach ($beritas as $berita) {
      $row['id'] = $berita->id;
      $row['judul'] = $berita->judul;
      if (!is_null($berita->filename)) {
	$row['filename'] = URL::to('public/image/'.$berita->filename);
      } else {
	$row['filename'] = '';
      }
      $datas[] = $row;
    }
    return $datas;
    }
    return '0';
  }
  
  public function cek(Request $request) {
    if ($this->ceklogin($request) == 1) {
      return Auth::user()->id;
    }
    return '0';
  }
  private function komentar1deleted($komentarid) {
      $komentar = TbKomentar::find($komentarid);
      if (!is_null($komentar->gambar) && !empty($komentar->gambar) && file_exists('public/image/'.$komentar->gambar)) {
	unlink('public/image/'.$komentar->gambar);
      }
      $komentar->delete();
      return '1';
  }
  
  public function komentardeleted(Request $request) {
    if ($this->ceklogin($request) == 1) {
      return $this->komentar1deleted($request->idkomentar);
    }
    return '0';
  }
  
  public function beritadeleted(Request $request) {
    if ($this->ceklogin($request) == 1) {
      $berita = TbBerita::find($request->id);
      
      $komentars = TbKomentar::select('id')->where('idberita', '=', $berita->id)->whereNotNull('gambar')->get();
      foreach ($komentar as  $komentars) {
	$this->komentar1deleted($komentar->id);
      }
      
      TbKomentar::where('idberita', '=', $berita->id)->delete();
      
      if (!is_null($berita->filename) && !empty($berita->filename) && file_exists('public/image/'.$berita->filename)) {
	unlink('public/image/'.$berita->filename);
      }
      $berita->delete();
      return '1';
    }
    return '0';
  }
  
  public function komentaradd(Request $request) {
    if ($this->ceklogin($request) == 1) {
    if (empty($request->idkomentar)) {
	$tbkomentar = new TbKomentar();
	$tbkomentar->idberita = $request->idberita;
      } else {
	$tbkomentar = TbKomentar::find($request->idkomentar);
	$imagedirectory = 'public/image/';
	if (($request->imageaction == 'hapus' || $request->imageaction == 'ubah') && !is_null($tbkomentar->gambar)
	  && !empty($tbkomentar->gambar) && file_exists($imagedirectory.$tbkomentar->gambar) ) {
	  unlink($imagedirectory.$tbkomentar->gambar);
	}
      }
      
      $tbkomentar->useridinput = Auth::user()->id;
      $tbkomentar->komentar = $request->komentar;
            
      if (!empty($request->input('gambar'))) {
	$tbkomentar->gambar = $request->input('gambar');
      } else if (empty($request->imageaction) && empty($request->idkomentar)) {
	$tbkomentar->gambar = null;
      } else if (!empty($request->imageaction) && !empty($request->idkomentar)
	&& $request->imageaction == 'hapus') {
	$tbkomentar->gambar = null;
      }
      
      if (empty($request->idkomentar)) {
	$tbkomentar->save();
      } else {
	$tbkomentar->update();
      }
      return '1';
    }
    return '0';
  }
  public function komentardata($idberita, Request $request) {
    $canaccess = '0';
    if ($this->ceklogin($request) == 1) {
      $canaccess = '1';
    }
    $komentars = [];
    $komentardata = TbKomentar::where('idberita', '=', $idberita)->orderBy('id')->get();
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
      
      $komentars[] = ['komentar' => $komentar->komentar, 'gambar' => $gambar,
      'id' => $komentar->id, 'useridinput' => $komentar->useridinput, 
      'idberita' => $komentar->idberita, 'isaccess' => $isaccess];
    }
    return $komentars;
  }
}
