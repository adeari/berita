<?php namespace App\Http\Controllers;

use App\Http\Controllers\MasterController;
use Illuminate\Http\Request;

use App\tables\TbBerita;
use App\tables\TbKomentar;
use App\tables\TbAdminPesan;

use DB;
use URL;
use Auth;
use App\User;
use Mail;

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
		$filter = '';
		$pagego = 1;
		$pencarian = '';
		if ($request->session()->has('beritatablepage')) {
      $fromsession = $request->session()->get('beritatablepage');

			$pencarian = $fromsession->pencarian;
			$pagego = $fromsession->pagego;
			$filter = $fromsession->filter;
			$tampilkan = $fromsession->tampilkan;
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

    session(['beritatablepage' => (object) [
      'tampilkan' => $request->tampilkan
      ,'filter' => $request->filter
      ,'pencarian' => $request->pencarian
      ,'pagego' => $request->pagego
    ]]);

		$totalberita = $qrydata->count();
		$datatbberita = $qrydata->skip($page)->take($limit)->get();

    $beritas = [];
    foreach ($datatbberita as $databerita) {
      $beritas[] = [
      	'id' => $databerita->id,
      	'judul' => $databerita->judul,
      	'jumlah_komentar' => number_format($databerita->jumlah_komentar, 0, ',','.'),
      	'jumlah_share' => number_format($databerita->jumlah_share, 0, ',','.'),
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

	public function users(Request $request) {
    $tampilkan = 'Baru Login';
		$filter = 'User Aktif';
		$pagego = 1;
		$pencarian = '';
		if ($request->session()->has('usertablepage')) {
      $fromsession = $request->session()->get('usertablepage');

			$pencarian = $fromsession->pencarian;
			$pagego = $fromsession->pagego;
			$filter = $fromsession->filter;
			$tampilkan = $fromsession->tampilkan;
		}

    return view('admin.users', [
			'tampilkan' => $tampilkan
			,'filter' => $filter
			,'pagego' => $pagego
			,'pencarian' => $pencarian
		]);
	}

	public function userstable(Request $request) {
		$limit = 50;
    $page = 0;
    if ($request->pagego) {
      $page = (intval($request->pagego) - 1) * $limit;
    }

    $qrydata = User::where('isadmin', '=', false);
		if ($request->tampilkan == 'Baru Login') {
			$qrydata = $qrydata->orderBy('lastlogin', 'desc');
		} else if ($request->tampilkan == 'Terlama Login') {
			$qrydata = $qrydata->orderBy('lastlogin', 'asc');
		} else if ($request->tampilkan == 'Terbanyak Berita') {
			$qrydata = $qrydata->orderBy('jumlah_berita', 'desc');
		} else if ($request->tampilkan == 'Tersedikit Berita') {
			$qrydata = $qrydata->orderBy('jumlah_share', 'asc');
		} else if ($request->tampilkan == 'Terbanyak Komentar') {
			$qrydata = $qrydata->orderBy('jumlah_komentar', 'desc');
		} else if ($request->tampilkan == 'Tersedikit Komentar') {
			$qrydata = $qrydata->orderBy('jumlah_komentar', 'asc');
		} else if ($request->tampilkan == 'Terbanyak Share') {
			$qrydata = $qrydata->orderBy('jumlah_share', 'desc');
		} else if ($request->tampilkan == 'Tersedikit Share') {
			$qrydata = $qrydata->orderBy('jumlah_share', 'asc');
		}

		if (!empty($request->filter)) {
			if ($request->filter == 'User Aktif') {
				$qrydata = $qrydata->where('aktif', '=' , true);
			} else if ($request->filter == 'User Blokir') {
				$qrydata = $qrydata->where('aktif', '=' , false);
			}
		}

		if (!empty($request->pencarian)) {
      $pencarian = $request->pencarian;
			$qrydata = $qrydata->where(function($query) use ($pencarian)
			{
					$query->orWhereRaw('username like \'%'.$pencarian.'%\'')
								->orWhereRaw('email like \'%'.$pencarian.'%\'')
								->orWhereRaw('nik like \'%'.$pencarian.'%\'')
								->orWhereRaw('name like \'%'.$pencarian.'%\'');
			});
		}

    session(['usertablepage' => (object) [
      'tampilkan' => $request->tampilkan
      ,'filter' => $request->filter
      ,'pencarian' => $request->pencarian
      ,'pagego' => $request->pagego
    ]]);

		$totaluser = $qrydata->count();
		$datausers = $qrydata->skip($page)->take($limit)->get();

    $userdatas = [];
    foreach ($datausers as $datauser) {
      $userdatas[] = [
      	'id' => $datauser->id,
      	'aktif' => $datauser->aktif,
      	'username' => $datauser->username,
      	'nik' => $datauser->nik,
      	'email' => $datauser->email,
      	'name' => $datauser->name,
      	'lastlogin' => $this->formatdatetimeshow($datauser->lastlogin),
      	'jumlah_berita' => number_format($datauser->jumlah_berita, 0, ',','.'),
      	'jumlah_komentar' => number_format($datauser->jumlah_komentar, 0, ',','.'),
      	'jumlah_share' => number_format($datauser->jumlah_share, 0, ',','.'),
      ];
    }
    $totalpage = floor($totaluser / $limit);
    if ($totaluser % $limit > 0) {
      $totalpage++;
    }
    return [
      'userdatas' => $userdatas,
      'totaluser' => number_format($totaluser, 0, ',','.'),
      'totalpage' => $totalpage,
    ];
	}

  public function userdetail($id, Request $request) {
    $userdata = User::find($id);
    $userdata->{'lastloginshow'} = $this->formatdatetimeshow($userdata->lastlogin);
    return view('admin.userdetail', [
        'userdata' => $userdata
    ]);
  }
  public function aktifkanusers(Request $request) {
    $userdata = null;
		foreach ($request->ids as $id) {
			if (is_null($userdata)) {
				$userdata = User::orWhere('id', '=', $id);
			} else {
				$userdata = $userdata->orWhere('id', '=', $id);
			}
		}
		$userdata->update(['aktif' => true]);
		return 1;
  }
  public function blokirusers(Request $request) {
    $userdata = null;
		foreach ($request->ids as $id) {
			if (is_null($userdata)) {
				$userdata = User::orWhere('id', '=', $id);
			} else {
				$userdata = $userdata->orWhere('id', '=', $id);
			}
		}
		$userdata->update(['aktif' => false]);
		return 1;
  }
  public function aktifkanuser($id) {
    User::orWhere('id', '=', $id)->update(['aktif' => true]);
    return redirect('admin-userdetail-'.$id);
  }
  public function blokiruser($id) {
    User::orWhere('id', '=', $id)->update(['aktif' => false]);
    return redirect('admin-userdetail-'.$id);
  }
  public function beritainusertable($id) {
    $datatbberita = TbBerita::orderBy('updated_at', 'desc')->where('useridinput', '=', $id)->get();
    $beritas = [];
    foreach ($datatbberita as $databerita) {
      $beritas[] = [
      	'id' => $databerita->id,
      	'judul' => $databerita->judul,
      	'jumlah_komentar' => number_format($databerita->jumlah_komentar, 0, ',','.'),
      	'jumlah_share' => number_format($databerita->jumlah_share, 0, ',','.'),
      	'kategori' => $databerita->kategori,
      	'populer' => $databerita->populer,
      ];
    }
    return [
      'beritas' => $beritas,
    ];
  }
  public function kirimpesanuser($id, Request $request) {
    if (!empty($request->judul) && !empty($request->pesan)) {
      $tbadminpesan = new TbAdminPesan();
      $tbadminpesan->judul = $request->judul;
      $tbadminpesan->pesan = $request->pesan;
      $tbadminpesan->userid = $id;
      $tbadminpesan->save();

      if (!is_null(Auth::user()->email) && !empty(Auth::user()->email) &&  filter_var( Auth::user()->email, FILTER_VALIDATE_EMAIL)) {
        $usersend = User::find($id);
        $dataemail = ['judul' => $request->judul, 'toemail' => $usersend->email];
        @Mail::send('emailku', ['pesan' => $request->pesan], function ($message) use ($dataemail) {
            $message->from('cs@surabayadigitalcity.net', 'Customer Service');
            $message->to($dataemail['toemail']);
            $message->subject($dataemail['judul']);
        });
        return 1;
      }
      return 2;
    }
  }
  public function grafik() {
    $month = date('m');
    if (strlen($month) < 2) {
      $month = '0'.$month;
    }
    $minyear = date('Y');
    $maxyear = date('Y');

    $datayear = TbBerita::select(DB::RAW('max(year(updated_at)) as maxyear'))->first();
    if (!is_null($datayear) && !empty($datayear)) {
      $maxyear = $datayear->maxyear;
    }

    $datayear = TbBerita::select(DB::RAW('min(year(updated_at)) as minyear'))->first();
    if (!is_null($datayear) && !empty($datayear)) {
      $minyear = $datayear->minyear;
    }

    $optionyear = [];
    $i = $minyear;
    while ($i <= $maxyear) {
      $optionyear[$i] = $i;
      $i++;
    }

    return view('admin.grafik', [
      'month' => $month
      ,'minyear' => $minyear
      ,'maxyear' => $maxyear
      ,'optionyear' => $optionyear
    ]);
  }
}
