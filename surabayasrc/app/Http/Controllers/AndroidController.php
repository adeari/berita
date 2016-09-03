<?php namespace App\Http\Controllers;

use App\Http\Controllers\MasterController;
use Illuminate\Http\Request;
use App\tables\TbBerita;
use URL;

class AndroidController extends MasterController
{
  public function beritaadd1(Request $request) {
    $tbberita = new TbBerita();
    $tbberita->judul = $this->removeUnusedCharacter($request->input('judul'));
    $tbberita->deskripsi = $this->removeUnusedCharacter($request->input('deskripsi'));
    $tbberita->kategori = $this->removeUnusedCharacter($request->input('kategori'));
	if (!empty($request->input('filename'))) {
		$tbberita->filename = $request->input('filename');
	} else {
		$tbberita->filename = null;
	}
    $tbberita->save();
    return '1';
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
  public function beritadetail($id) {
    $berita = TbBerita::find($id);
    $row['id'] = $berita->id;
    $row['judul'] = $berita->judul;
    $row['deskripsi'] = $berita->deskripsi;
    $row['tanggal'] = substr($berita->updated_at, 8, 2).'/'.substr($berita->updated_at, 5, 2).'/'.substr($berita->updated_at, 0, 4).substr($berita->updated_at, 10, 6);
    if (!is_null($berita->filename)) {
      $row['filename'] = URL::to('public/image/'.$berita->filename);
    } else {
      $row['filename'] = '';
    }
    return $row;
  }
  public function getfilename($extension) {
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
  public function androidmendaftar(Request $request) {
    return $this->mendaftar($request);
  }
  public function androidlogin(Request $request) {
    return $this->ceklogin($request);
  }
}
