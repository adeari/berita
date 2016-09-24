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
    		$folderupload = 'public/image/';
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
    			move_uploaded_file($file['tmp_name'], $pathnewfilename);
    			$return['filename'] = $newfilename;
    		} else {
    			$return['success'] = '0' ;
    			$return['msg'] = 'Upload file gambar saja';
    			return $return;
    		}
    	}
    	return $return;
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
	
}
