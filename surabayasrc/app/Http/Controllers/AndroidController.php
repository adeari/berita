<?php namespace App\Http\Controllers;

use App\Http\Controllers\MasterController;
use Illuminate\Http\Request;
use App\tables\TbBerita;
use URL;
use Auth;
use App\tables\TbKomentar;
use App\tables\TbLokasi;
use App\tables\TbBroadcastPesan;
use App\tables\TbPesanCustomer;
use App\tables\TbAdminPesan;
use App\User;
use DB;

class AndroidController extends MasterController
{
  private function ceklogin(Request $request) {
    $canlogin = 0;
    if (Auth::attempt(array('username' => $request->usernamenik, 'password' => $request->password))) {
      $canlogin = 1;
    } else if (Auth::attempt(array('nik' => $request->usernamenik, 'password' => $request->password))) {
      $canlogin = 1;
    }
    if ($canlogin) {
      if (Auth::user()->isadmin) {
        return 0;
      } else if (Auth::user()->aktif) {
        return $canlogin;
      }
    }
    return 0;
  }

  public function beritaadd1(Request $request) {
    if ($this->ceklogin($request) == 1) {
      $this->commonactionn();
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
	DB::statement("UPDATE users SET jumlah_berita = (select count(*) from tbberita where tbberita.useridinput = ".Auth::user()->id.") where id=".Auth::user()->id);
      } else {
	$tbberita->update();
      }
      return '1';
    }
    return '0';
  }
  public function populer(Request $request) {
  if ($this->ceklogin($request) == 1) {
    $this->commonactionn();
  }
    $datas = [];
    $beritas = TbBerita::where('populer', '=', true)-> orderBy('updated_at', 'desc');
    if (!empty($request->pencarian)) {
      $beritas = $beritas->whereRaw('judul like \'%'.$request->pencarian.'%\'');
    }
    $beritas = $beritas->get();
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

  public function terbaru(Request $request) {
    if ($this->ceklogin($request) == 1) {
      $this->commonactionn();
    }
    $datas = [];
    $beritas = TbBerita::orderBy('updated_at', 'desc');
    if (!empty($request->pencarian)) {
      $beritas = $beritas->whereRaw('judul like \'%'.$request->pencarian.'%\'');
    }
    $beritas = $beritas->get();

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
  if ($this->ceklogin($request) == 1) {
    $this->commonactionn();
    }
    $berita = TbBerita::find($id);
    $row['id'] = $berita->id;
    $row['judul'] = $berita->judul;
    $row['deskripsi'] = $berita->deskripsi;
    $row['kategori'] = $berita->kategori;
    $row['tanggal'] = substr($berita->updated_at, 8, 2).'/'.substr($berita->updated_at, 5, 2).'/'.substr($berita->updated_at, 0, 4).substr($berita->updated_at, 10, 6);
    $userberita = User::find($berita->useridinput);
    if (!empty($userberita->gambar)) {
      $userberita->gambar = URL::to('public/image/'.$userberita->gambar);
    }
    $row['user1'] = $userberita;
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

  public function artikelname($artikelname,Request $request) {
  if ($this->ceklogin($request) == 1) {
    $this->commonactionn();
    }
    $datas = [];
    $beritas = TbBerita::where('kategori', '=', $artikelname)->orderBy('updated_at', 'desc');
    if (!empty($request->pencarian)) {
      $beritas = $beritas->whereRaw('judul like \'%'.$request->pencarian.'%\'');
    }
    $beritas = $beritas->get();
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
    $this->commonactionn();
      $datas = [];
    $beritas = TbBerita::where('useridinput', '=', Auth::user()->id)->orderBy('updated_at', 'desc');
    if (!empty($request->pencarian)) {
      $beritas = $beritas->whereRaw('judul like \'%'.$request->pencarian.'%\'');
    }
    $beritas = $beritas->get();

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

  public function komentardeleted(Request $request) {
    if ($this->ceklogin($request) == 1) {
      $this->commonactionn();
      return $this->komentar1deleted($request->idkomentar, true);
    }
    return '0';
  }

  public function beritadeleted(Request $request) {
    if ($this->ceklogin($request) == 1) {
      $this->commonactionn();
      $this->deleteberita($request);
      return '1';
    }
    return '0';
  }

  public function komentaradd(Request $request) {
    if ($this->ceklogin($request) == 1) {
      $this->commonactionn();
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
	DB::statement("UPDATE tbberita SET jumlah_komentar = (select count(*) from tbkomentar where tbkomentar.idberita = ".$request->idberita.") where id= ".$request->idberita);
	DB::statement("UPDATE users SET jumlah_komentar = (select count(*) from tbkomentar where tbkomentar.useridinput = ".Auth::user()->id.") where id=".Auth::user()->id);
      } else {
	$tbkomentar->update();
      }
      return '1';
    }
    return '0';
  }
  public function komentardata($idberita, Request $request) {
  if ($this->ceklogin($request) == 1) {
    $this->commonactionn();
    }
    $canaccess = '0';
    if ($this->ceklogin($request) == 1) {
      $canaccess = '1';
    }
    return $this->getkomentardata($canaccess, $idberita);
  }

  public function profileuser(Request $request) {
  if ($this->ceklogin($request) == 1) {
    $this->commonactionn();
    $gambar = "";
    if (!is_null(Auth::user()->gambar) && !empty(Auth::user()->gambar)) {
      $gambar = URL::to('public/image/'.Auth::user()->gambar);
    }
    return [
      'name' => Auth::user()->name
      ,'nik' => Auth::user()->nik
      ,'gambar' => $gambar
      ,'username' => Auth::user()->username
      ,'email' => Auth::user()->email
    ];
  }
  }
  public function profileuseredit(Request $request) {
    if ($this->ceklogin($request) == 1) {
      if (!empty($request->email)) {
        if (User::where('email', '=', $request->email)->where('id', '!=', Auth::user()->id)->count() > 0) {
          return ['success' => 0, 'msg' => 'Email sudah dipakai user lain'];
        }
      }
      if (!empty($request->nik)) {
        if (User::where('nik', '=', $request->nik)->where('id', '!=', Auth::user()->id)->count() > 0) {
          return ['success' => 0, 'msg' => 'NIK sudah dipakai user lain'];
        }
      }
      $this->commonactionn();
      $this->editprofile($request);
    }
    return ['success' => 1];
  }
  public function profilegantipassword(Request $request) {
    if ($this->ceklogin($request) == 1) {
      $this->commonactionn();
      $this->gantipassword($request);
    }
    return 0;
  }
  public function lokasiadd(Request $request) {
    if ($this->ceklogin($request) == 1) {
	$tblokasi = new TbLokasi();
	$tblokasi->langitude = $request->langitude;
	$tblokasi->longitude = $request->longitude;
	$tblokasi->userid = Auth::user()->id;
	$tblokasi->save();
    }
    return 0;
  }

  public function getpesanuser($request) {
    $datapesan = TbAdminPesan::where('userid', '=', Auth::user()->id)->get();
    $result = [];
    foreach ($datapesan as $pesan) {
      $result[] = ['id' => $pesan->id
        ,'judul' => $pesan->judul
        ,'pesan' => $pesan->pesan
      ];
    }
    return $result;
  }
  public function getpesanafterlogin(Request $request) {
    if ($this->ceklogin($request) == 1) {
      return ['pesan' => TbBroadcastPesan::first()->pesan, 'pesanpribadi' => $this->getpesanuser($request)];
    }
    return 1;
  }

  public function deletepesanuser($id, Request $request) {
    if ($this->ceklogin($request) == 1) {
      TbAdminPesan::find($id)->delete();
    }
    return 1;
  }
  public function kirimpesancs(Request $request) {
    return $this->kirimpesancsmaster($request);
  }
  public function addshareberitauser(Request $request) {
    if ($this->ceklogin($request) == 1) {
      User::where('id', '=', Auth::user()->id)->update(['jumlah_share' => DB::raw('jumlah_share + 1')]);
      return 1;
    }
  }
}
