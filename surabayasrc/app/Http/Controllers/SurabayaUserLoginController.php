<?php namespace App\Http\Controllers;

use App\Http\Controllers\MasterController;
use Illuminate\Http\Request;
use App\tables\TbBerita;
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
  public function beritaadd() {
    	return view('user.beritaadd');
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
			$filename = $return['filename'];
			$tbberita = new TbBerita();
			$tbberita->judul = $this->removeUnusedCharacter($request->input('judul'));
			$tbberita->deskripsi = $this->removeUnusedCharacter($request->input('deskripsi'));
			$tbberita->kategori = $this->removeUnusedCharacter($request->input('kategori'));
			$tbberita->useridinput = Auth::User()->id;
			if (!is_null($filename)) {
				$tbberita->filename = $filename;
			}
			$tbberita->save();
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
}