<?php namespace App\Http\Controllers;

use App\Http\Controllers\MasterController;
use Illuminate\Http\Request;
use App\tables\TbBerita;
use URL;

class SurabayaAwalController extends MasterController
{
    public function index() {
    	$beritas = '';
    	$databeritas = TbBerita::all();
    	$folderimage = 'public/image';
    	foreach ($databeritas as $databerita) {
    		$width = 0;
    		$height = 0;
    		$filename = $databerita->filename;
    		if (!is_null($filename)) {
    			$pathfilename =  $folderimage.'/'.$filename;
    			$filename = URL::to($pathfilename);
    			list($width, $height) = getimagesize($pathfilename);
    			if ($width > 300) {
    				$height = intval($height * 300 / $width);
    				$width = 300;
    			}
    		}
    		if (strlen($beritas) > 0) {
    			$beritas .= ',';
    		}
    		$tanggal = substr($databerita->updated_at, 8, 2).'/'.substr($databerita->updated_at, 5, 2).'/'.substr($databerita->updated_at, 0, 4).substr($databerita->updated_at, 10, 6);
    		$beritas .= '{id:'.$databerita->id.', filename:\''.$filename.'\', width:\''.$width.'\', height:\''.$height.'\', judul:\''.$databerita->judul.'\', deskripsi: \''.$databerita->deskripsi.'\'
    				,tanggal:\''.$tanggal.'\'}';
    	}
    	return view('populer', [
    			'beritas' => $beritas
    	]);
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
			$tbberita->judul = $request->input('judul');
			$tbberita->deskripsi = $request->input('deskripsi');
			$tbberita->kategori = $request->input('kategori');
			if (!is_null($filename)) {
				$tbberita->filename = $filename;
			}
			$tbberita->save();
		}
		return $return;
	}
}
