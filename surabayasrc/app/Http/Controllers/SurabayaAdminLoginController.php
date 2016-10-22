<?php namespace App\Http\Controllers;

use App\Http\Controllers\MasterController;
use Illuminate\Http\Request;

use App\tables\TbBerita;
use App\tables\TbKomentar;

use DB;
use URL;
use Auth;
use App\User;

class SurabayaAdminLoginController extends MasterController
{
  public function __construct()
  {
    $this->middleware('auth');
		if (!Auth::user()->isadmin) {
			echo 0;
			exit;
		}
  }
  public function berita(Request $request) {
		$tampilkan = 'Berita Terbaru ke Berita Terlama';
		if ($request->tampilkan) {
			$tampilkan = $request->tampilkan;
		}
		
		$filter = '';
		if ($request->filter) {
			$filter = $request->filter;
		}
		
		$pagego = 1;
		if ($request->pagego) {
			$pagego = $request->pagego;
		}
		
		$pencarian = '';
		if ($request->pencarian) {
			$pencarian = $request->pencarian;
		}
		
    return view('admin.berita', [
			'tampilkan' => $tampilkan 
			,'filter' => $filter 
			,'pagego' => $pagego
			,'pencarian' => $pencarian
		]);
  }
  public function beritatable(Request $request) {
    $limit = 50;
    $page = 0;
    if ($request->pagego) {
      $page = (intval($request->pagego) - 1) * $limit;
    }
		
		$qrydata = TbBerita::orderBy('updated_at', 'desc');
		if ($request->tampilkan == 'Berita Terlama ke Berita Terbaru') {
			$qrydata = TbBerita::orderBy('updated_at', 'asc');
		} else if ($request->tampilkan == 'Komentar Terbanyak ke sedikit') {
			$qrydata = TbBerita::orderBy('jumlah_komentar', 'desc');
		} else if ($request->tampilkan == 'Komentar Sedikit ke banyak') {
			$qrydata = TbBerita::orderBy('jumlah_komentar', 'asc');
		} else if ($request->tampilkan == 'Terbanyak di share ke sedikit') {
			$qrydata = TbBerita::orderBy('jumlah_share', 'desc');
		} else if ($request->tampilkan == 'Sedikit di share ke banyak') {
			$qrydata = TbBerita::orderBy('jumlah_share', 'asc');
		} 
		
		if (!empty($request->filter)) {
			if ($request->filter == 'Populer') {
				$qrydata = $qrydata->where('populer', '=' , true);
			} else {
				$qrydata = $qrydata->where('kategori', '=' , $request->filter);
			}
		}
		
		if (!empty($request->pencarian)) {
			$qrydata = $qrydata->whereRaw("judul like '%". $request->pencarian."%'");
		}
		$totalberita = $qrydata->count();
		$datatbberita = $qrydata->skip($page)->take($limit)->get();
		
		
    $beritas = [];
    foreach ($datatbberita as $databerita) {
      $beritas[] = [
      	'id' => $databerita->id,
      	'judul' => $databerita->judul,
      	'jumlah_komentar' => $databerita->jumlah_komentar,
      	'jumlah_share' => $databerita->jumlah_share,
      	'kategori' => $databerita->kategori,
      	'populer' => $databerita->populer,
      ];
    }
    $totalpage = floor($totalberita / $limit);
    if ($totalberita % $limit > 0) {
      $totalpage++;
    }
    return [
      'beritas' => $beritas,
      'totalberita' => number_format($totalberita, 0, ',','.'),
      'totalpage' => $totalpage,
    ];
  }
	public function populerkanberitas(Request $request) {
		$tbberitas = null;
		foreach ($request->ids as $id) {
			if (is_null($tbberitas)) {
				$tbberitas = TbBerita::orWhere('id', '=', $id);
			} else {
				$tbberitas = $tbberitas->orWhere('id', '=', $id);
			}
		}
		$tbberitas->update(['populer' => true]);
		return 1;
	}
	public function batalpopulerkanberitas(Request $request) {
		$tbberitas = null;
		foreach ($request->ids as $id) {
			if (is_null($tbberitas)) {
				$tbberitas = TbBerita::orWhere('id', '=', $id);
			} else {
				$tbberitas = $tbberitas->orWhere('id', '=', $id);
			}
		}
		$tbberitas->update(['populer' => false]);
		return 1;
	}
	
	private function setcountuser() {
		DB::statement("UPDATE users SET jumlah_komentar = (select count(*) from tbkomentar where tbkomentar.useridinput = users.id)");
		DB::statement("UPDATE users SET jumlah_berita = (select count(*) from tbberita where tbberita.useridinput = users.id)");
	}
	public function deleteberitas(Request $request) {
		foreach ($request->ids as $id) {
			$this->deleteberitabyid($id, false);
		}
		$this->setcountuser();
		return 1;
	}
	
	private function backtoberitadetail($request) {
		$parameter = '';
		foreach ($request->query as $key => $val) {
			if ($key != 'beritaid' && $key != 'backpage') {
				if (empty($parameter)) {
					$parameter = '?'.$key .'='. $val;
				} else {
					$parameter .= '&'.$key .'='. $val;
				}
			}
		}
		return redirect('admin-beritadetail-'.$request->beritaid.'-'.$request->backpage.$parameter);
	}
	public function batalpopuler1(Request $request) {
		TbBerita::where('id', '=', $request->beritaid)->update(['populer' => false]);
		return $this->backtoberitadetail($request);
	}
	public function populer1(Request $request) {
		TbBerita::where('id', '=', $request->beritaid)->update(['populer' => true]);
		return $this->backtoberitadetail($request);
	}
	public function hapusberita1(Request $request) {
		$parameter = '';
		foreach ($request->query as $key => $val) {
			if ($key != 'beritaid' && $key != 'backpage') {
				if (empty($parameter)) {
					$parameter = '?'.$key .'='. $val;
				} else {
					$parameter .= '&'.$key .'='. $val;
				}
			}
		}
		
		$this->deleteberitabyid($request->beritaid, false);
		$this->setcountuser();
		
		return redirect($request->backpage.$parameter);
	}
	
	public function beritadetail($id, $backpage = '', Request $request) {
		return view('admin.beritadetail', $this->parameterdetail($id, $backpage, $request));
	}
}
