<?php namespace App\Http\Controllers;

use App\Http\Controllers\MasterController;
use Illuminate\Http\Request;

use App\tables\TbBerita;
use App\tables\TbKomentar;

use DB;
use URL;
use Auth;
use App\User;

class SurabayaUserLoginController extends MasterController
{
  public function __construct()
  {
    $this->middleware('auth');
    $this->commonactionn();
  }
  public function beritaadd(Request $request) {
      $beritaedit = null;
      if (isset($request->id)) {
	$beritaedit = TbBerita::find($request->id);
      }
    	return view('user.beritaadd', ['beritaedit' => $beritaedit]);
    }
    public function uploadfile() {
    	$return['success'] = '1' ;
    	$return['msg'] = 'success' ;
    	$return['filename'] = null;

    	foreach($_FILES as $file)
    	{
    		$folderupload = public_path().'/image/';
    		$sizefile = $file['size'];
    		$filename = $file['name'];

    		$extensionexplode = explode(".", $filename);
    		$extensioncount = count($extensionexplode) - 1;
    		if (strlen($extensioncount) == 0) {
    			$return['success'] = '0' ;
    			$return['msg'] = 'File harus memiliki ekstensi' ;
    			return $return;
    		}
    		$newfilename = '';
    		$i = 0;
    		$extension = '';
    		foreach ($extensionexplode as $extensionexplode1) {
    			if ($i < $extensioncount) {
    				$newfilename .= $extensionexplode1;
    			} else {
    				$extension = $extensionexplode1;
    			}
    			$i++;
    		}
    		$extension = strtolower($extension);
    		if ($extension == "jpg" || $extension == "jpeg" || $extension == "png" || $extension == "bmp") {
    			if (strlen($newfilename) > 240) {
    				$newfilename = substr($newfilename, 0, 240);
    			}
    			$filenameExist = true;
    			$newfilenamecek = $newfilename;
    			$newfilename = $newfilename . '.' . $extension;
    			while ($filenameExist) {
    				if (file_exists($folderupload.$newfilename)) {
    					$newfilename = $newfilenamecek.$this->generateRandomString(6). '.' . $extension;
    				} else {
    					$filenameExist = false;
    				}
    			}
    			$pathnewfilename = $folderupload.$newfilename;
    			$return['filename'] = $newfilename;
    			move_uploaded_file($file['tmp_name'], $pathnewfilename);
    			$this->resizeimage($pathnewfilename);
    		} else {
    			$return['success'] = '0' ;
    			$return['msg'] = 'Upload file gambar saja';
    			return $return;
    		}
    	}
    	return $return;
    }

    private function resizeimage($pathnewfilename) {
      if (!empty($pathnewfilename) && file_exists($pathnewfilename)) {
	$image_info = getimagesize($pathnewfilename);
	$standradwidth = $image_info[0];
	$standardheight = $image_info[1];
	$imagetype = $image_info[2];

	$width = 500;
	if ($width < $standradwidth) {
	  $height = $width * $standardheight / $standradwidth;
	  if ($imagetype == IMAGETYPE_JPEG) {
	    $image = imagecreatefromjpeg($pathnewfilename);
	    $newImage = imagecreatetruecolor($width, $height);
	    imagecopyresampled($newImage, $image, 0, 0, 0, 0, $width, $height, $standradwidth, $standardheight);
	    imagejpeg($newImage, $pathnewfilename, 100);
	  } else if ($imagetype == IMAGETYPE_PNG) {
	    $image = imagecreatefrompng($pathnewfilename);
	    $newImage = imagecreatetruecolor($width, $height);
	    imagecopyresampled($newImage, $image, 0, 0, 0, 0, $width, $height, $standradwidth, $standardheight);
	    imagepng($newImage, $pathnewfilename, 100);
	  } else if ($imagetype == IMAGETYPE_BMP) {
	    $image = imagecreatefromwbmp($pathnewfilename);
	    $newImage = imagecreatetruecolor($width, $height);
	    imagecopyresampled($newImage, $image, 0, 0, 0, 0, $width, $height, $standradwidth, $standardheight);
	    imagewbmp($newImage, $pathnewfilename, 100);
	  } else if ($imagetype == IMAGETYPE_GIF) {
	    $image = imagecreatefromgif($pathnewfilename);
	    $newImage = imagecreatetruecolor($width, $height);
	    imagecopyresampled($newImage, $image, 0, 0, 0, 0, $width, $height, $standradwidth, $standardheight);
	    imagegif($newImage, $pathnewfilename, 100);
	  }
	}
      }
    }

	public function addberita(Request $request) {
		$return = $this->uploadfile();
		if ($return['success'] == '1') {
		  $deletedfile = '';
			$filename = $return['filename'];
			if (empty($request->beritaid)) {
			  $tbberita = new TbBerita();
			} else {
			  $tbberita = TbBerita::find($request->beritaid);
			  if (!empty($request->hapusimage) && !is_null($tbberita->filename)) {
			    $deletedfile = $tbberita->filename;
			  }
			}

			$tbberita->judul = $this->removeUnusedCharacter($request->input('judul'));
			$tbberita->deskripsi = $this->removeUnusedCharacter($request->input('deskripsi'));
			$tbberita->kategori = $this->removeUnusedCharacter($request->input('kategori'));
			$tbberita->useridinput = Auth::User()->id;
			if (!is_null($filename)) {
			  if (!empty($request->beritaid) && !is_null($tbberita->filename)) {
			    $deletedfile = $tbberita->filename;
			  }
			  $tbberita->filename = $filename;
			}
			if (!empty($request->hapusimage)) {
			  $tbberita->filename = null;
			}
			if (empty($request->beritaid)) {
			  $tbberita->save();
			  DB::statement("UPDATE users SET jumlah_berita = (select count(*) from tbberita where tbberita.useridinput = ".Auth::user()->id.") where id=".Auth::user()->id);
			} else {
			  $tbberita->update();
			}
		  if (!empty($deletedfile) && file_exists(public_path().'/image/'.$deletedfile)) {
		    unlink(public_path().'/image/'.$deletedfile);
		  }
		}
		return $return;
	}
  public function saya() {
    return view('user.saya', ['profile' => User::find(Auth::user()->id)]);
  }

  public function changepassword(Request $request) {
    $this->gantipassword($request);
  }
  public function changeprofile(Request $request) {
    $return = $this->uploadfile();
    if ($return['success'] == '1') {
      $request->gambar = (is_null($return['filename']) ? '' : $return['filename']);
      $user = User::find(Auth::user()->id);
      $deletedimage = '';
      if (!empty($request->gambar) && !empty($user->gambar) && file_exists(public_path().'/image/'.$user->gambar)) {
	$deletedimage = public_path().'/image/'.$user->gambar;
      }
      $this->editprofile($request);
      if (!empty($deletedimage)) {
	unlink($deletedimage);
      }
    }
    return $return;
  }
  public function beritasaya() {
    $beritas = '';
    $databeritas = TbBerita::orderBy('id', 'desc')->where('useridinput', '=', Auth::user()->id)->get();
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
	    ,showhapusbutton:true
	    ,showlayoutconfirmhapus:false
			    ,tanggal:\''.$tanggal.'\'}';
    }
    return view('user.beritasaya', [
		    'beritas' => $beritas
		    , 'backpage' => 'berita-saya'
    ]);
  }
  public function beritahapus(Request $request) {
    $this->deleteberita($request);
    return 1;
  }

  public function addkomentar(Request $request) {
    $return = $this->uploadfile();
    $hapusfile = '';
    $folderupload = public_path().'/image/';
    if ($return['success'] == '1') {
      if (!isset($request->idkomentar)) {
	$tbkomentar = new TbKomentar();
	$tbkomentar->idberita = $request->idberita;
      } else {
	$tbkomentar = TbKomentar::find($request->idkomentar);
	if (!is_null($tbkomentar->gambar) && !empty($tbkomentar->gambar) && (isset($request->hapusgambar)) || !is_null($return['filename'])) {
	  $hapusfile = $tbkomentar->gambar;
	}
      }
      $tbkomentar->useridinput = Auth::user()->id;
      $tbkomentar->komentar = $request->komentar;
      if (!is_null($return['filename']) && !isset($request->hapusgambar)) {
	$tbkomentar->gambar = $return['filename'];
      } else if (isset($request->hapusgambar)) {
	$tbkomentar->gambar = null;
      }

      if (!isset($request->idkomentar)) {
	$tbkomentar->save();
	DB::statement("UPDATE tbberita SET jumlah_komentar = (select count(*) from tbkomentar where tbkomentar.idberita = ".$request->idberita.") where id = ".$request->idberita);
	DB::statement("UPDATE users SET jumlah_komentar = (select count(*) from tbkomentar where tbkomentar.useridinput = ".Auth::user()->id.") where id=".Auth::user()->id);
      } else {
	$tbkomentar->update();
      }

      if (!empty($hapusfile) && file_exists($folderupload.$hapusfile)) {
	unlink($folderupload.$hapusfile);
      }
    }
    return $return;
  }
  public function komentarhapus(Request $request) {
    return $this->komentar1deleted($request->idkomentar, true);
  }
  public function addshareberitauser() {
    User::where('id', '=', Auth::user()->id)->update(['jumlah_share' => DB::raw('jumlah_share + 1')]);
    return 1;
  }
}
