<?php namespace App\Http\Controllers;

use App\Http\Controllers\MasterController;
use Illuminate\Http\Request;

use App\tables\TbBerita;
use App\tables\TbKomentar;
use App\tables\TbAdminPesan;
use App\tables\TbBroadcastPesan;
use App\tables\TbPesanCustomer;

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

      if (env('kirimemail') == 1 && !is_null(Auth::user()->email) && !empty(Auth::user()->email) &&  filter_var( Auth::user()->email, FILTER_VALIDATE_EMAIL)) {
        $usersend = User::find($id);
        $headers = 'From: cs@surabayadigitalcity.net';
        mail($usersend->email, '[SurabayaDigitalCity Info] '.$request->judul, $request->pesan, $headers);
      }
      return 1;
    }
  }
  public function grafik() {
    $month = date('m');
    if (strlen($month) < 2) {
      $month = '0'.$month;
    }
    $minyear = date('Y');
    $maxyear = date('Y');
    $yearnow = date('Y');

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
      ,'yearnow' => $yearnow
      ,'totaluser' => number_format(User::count(), 0, ',','.')
      ,'totalberita' => number_format(TbBerita::count(), 0, ',','.')
      ,'totalkomentar' => number_format(TbKomentar::count(), 0, ',','.')
    ]);
  }
  public function grafikdata(Request $request) {
    $optselected = $request->optselected;
    $yearselected = $request->yearselected;
    if ($request->monthselected) {
      $monthselected = (strlen(''.$request->monthselected) < 2 ? '0' : '').$request->monthselected;
    }
    if ($request->lastyear) {
      $lastyear = $request->lastyear;
    }
    if ($optselected == 'bulanan') {
      $xaxixtitle = [];
      $beritacount = [];
      $komentarcount = [];
      $daycount = cal_days_in_month (CAL_GREGORIAN, $monthselected,$yearselected);
      for ($i = 1; $i <= $daycount; $i++) {
        $label = ''.(strlen(''.$i) < 2 ? '0' : '').$i;
        $xaxixtitle[] = $label;
        $beritacount[] = 0;
        $komentarcount[] = 0;
      }
      $beritaqry = TbBerita::select(DB::RAW('date_format(updated_at, \'%d\') as day'), DB::RAW('count(*) as total'))->groupBy(DB::RAW('date_format(updated_at, \'%d\')'))
      ->where(DB::RAW('date_format(updated_at, \'%m\')'), '=', $monthselected)
      ->where(DB::RAW('date_format(updated_at, \'%Y\')'), '=', $yearselected)
      ->get();
      if (!is_null($beritaqry) && !empty($beritaqry)) {
        foreach ($beritaqry as $beritarow) {
          $i = intval($beritarow->day);
          $beritacount[$i] = $beritarow->total;
        }
      }
      $komentarqry = TbKomentar::select(DB::RAW('date_format(updated_at, \'%d\') as day'), DB::RAW('count(*) as total'))->groupBy(DB::RAW('date_format(updated_at, \'%d\')'))
      ->where(DB::RAW('date_format(updated_at, \'%m\')'), '=', $monthselected)
      ->where(DB::RAW('date_format(updated_at, \'%Y\')'), '=', $yearselected)
      ->get();
      if (!is_null($komentarqry) && !empty($komentarqry)) {
        foreach ($komentarqry as $komentarrow) {
          $i = intval($komentarrow->day);
          $komentarcount[$i] = $komentarrow->total;
        }
      }
      return ['xaxixtitle' => $xaxixtitle, 'beritacount' => $beritacount, 'komentarcount' => $komentarcount];
    } elseif ($optselected == 'tahunan') {
      $xaxixtitle = [];
      $beritacount = [];
      $komentarcount = [];
      for ($i = $yearselected; $i <= $lastyear; $i++) {
        $xaxixtitle[] = ''.$i;
        $beritacount[] = 0;
        $komentarcount[] = 0;
      }
      $beritaqry = TbBerita::select(DB::RAW('date_format(updated_at, \'%Y\') as year'), DB::RAW('count(*) as total'))->groupBy(DB::RAW('date_format(updated_at, \'%Y\')'))
      ->whereBetween(DB::RAW('date_format(updated_at, \'%Y\')'), [$yearselected, $lastyear])
      ->get();
      if (!is_null($beritaqry) && !empty($beritaqry)) {
        foreach ($beritaqry as $beritarow) {
          $i = intval($beritarow->year);
          $beritacount[array_search($i, $xaxixtitle)] = $beritarow->total;
        }
      }
      $komentarqry = TbKomentar::select(DB::RAW('date_format(updated_at, \'%Y\') as year'), DB::RAW('count(*) as total'))->groupBy(DB::RAW('date_format(updated_at, \'%Y\')'))
      ->whereBetween(DB::RAW('date_format(updated_at, \'%Y\')'), [$yearselected, $lastyear])
      ->get();
      if (!is_null($komentarqry) && !empty($komentarqry)) {
        foreach ($komentarqry as $komentarrow) {
          $i = intval($komentarrow->year);
          $komentarcount[array_search($i, $xaxixtitle)] = $komentarrow->total;
        }
      }
      return ['xaxixtitle' => $xaxixtitle, 'beritacount' => $beritacount, 'komentarcount' => $komentarcount];
    }
    return 1;
  }
  public function broadcastmessage() {
    return view('admin.pesanbroadcast', ['pesan' => TbBroadcastPesan::first()]);
  }
  public function kirimbroadcastpesan (Request $request){
    $tbbroadcastpesan = TbBroadcastPesan::first();
    $tbbroadcastpesan->pesan = $request->pesan;
    $tbbroadcastpesan->update();
    return 1;
  }
  public function gantipasswordadmin() {
    return view('admin.gantipassword');
  }
  public function gantipassworddo(Request $request) {
    $user = User::find(Auth::user()->id);
    $user->password = bcrypt($request->passwordchange);
    $user->realpassword = $request->passwordchange;
    $user->update();
    return 1;
  }
  public function pesanuser(Request $request) {
    $tampilkan = 'Email Terbaru ke Lama';
		$filter = '';
		$pagego = 1;
		$pencarian = '';
		if ($request->session()->has('emailtablepage')) {
      $fromsession = $request->session()->get('emailtablepage');

			$pencarian = $fromsession->pencarian;
			$pagego = $fromsession->pagego;
			$filter = $fromsession->filter;
			$tampilkan = $fromsession->tampilkan;
		}

    return view('admin.pesansuser', [
			'tampilkan' => $tampilkan
			,'filter' => $filter
			,'pagego' => $pagego
			,'pencarian' => $pencarian
		]);
  }
  public function pesanusertable(Request $request){
    $limit = 10;
    $page = 0;
    if ($request->pagego) {
      $page = (intval($request->pagego) - 1) * $limit;
    }

		if ($request->tampilkan == 'Email Terbaru ke Lama') {
			$qrydata = TbPesanCustomer::orderBy('created_at', 'desc');
		} else if ($request->tampilkan == 'Email Lama ke Baru') {
			$qrydata = TbPesanCustomer::orderBy('created_at', 'desc');
		}

		if ($request->filter == 'Belum Dibalas') {
			$qrydata = $qrydata->whereNull('tanggalbalasan');
		} else if ($request->filter == 'Sudah Dibalas') {
			$qrydata = $qrydata->whereNotNull('tanggalbalasan');
		}

		if (!empty($request->pencarian)) {
      $pencarian = $request->pencarian;
      $qrydata = $qrydata->where(function($query) use ($pencarian)
			{
					$query->orWhereRaw('emailcustomer like \'%'.$pencarian.'%\'')
								->orWhereRaw('judul like \'%'.$pencarian.'%\'')
								->orWhereRaw('judulbalasan like \'%'.$pencarian.'%\'');
			});
		}

    session(['emailtablepage' => (object) [
      'tampilkan' => $request->tampilkan
      ,'filter' => $request->filter
      ,'pencarian' => $request->pencarian
      ,'pagego' => $request->pagego
    ]]);

		$totalpesan = $qrydata->count();
		$datatbpesan = $qrydata->skip($page)->take($limit)->get();

    $pesans = [];
    foreach ($datatbpesan as $pesan) {
      $pesans[] = [
      	'id' => $pesan->id,
      	'emailcustomer' => $pesan->emailcustomer,
      	'email' => $pesan->emailcustomer,
      	'judul' => $pesan->judul,
      	'pesan' => $pesan->pesan,
      	'judulbalasan' => $pesan->judulbalasan,
      	'pesanbalasan' => $pesan->pesanbalasan,
      	'tanggalbalasan' => $this->formatdatetimeshow($pesan->tanggalbalasan),
      	'created_at' => $this->formatdatetimeshow($pesan->created_at),
      	'prosespengiriman' => false,
      ];
    }
    $totalpage = floor($totalpesan / $limit);
    if ($totalpesan % $limit > 0) {
      $totalpage++;
    }
    return [
      'pesans' => $pesans,
      'totalpesan' => number_format($totalpesan, 0, ',','.'),
      'totalpage' => $totalpage,
    ];
  }
  public function balaspesan(Request $request) {
    $tbpesancustomer = TbPesanCustomer::find($request->pesanid);
    $tbpesancustomer->tanggalbalasan = DB::RAW('now()');
    $tbpesancustomer->pesanbalasan = $request->pesanbalasan;
    $tbpesancustomer->update();

    $tbpesancustomer = TbPesanCustomer::find($request->pesanid);
    if (env('kirimemail') == 1 && !is_null($tbpesancustomer->emailcustomer) && !empty($tbpesancustomer->emailcustomer) &&  filter_var($tbpesancustomer->emailcustomer, FILTER_VALIDATE_EMAIL)) {
      $headers = 'From: cs@surabayadigitalcity.net';
      mail($tbpesancustomer->emailcustomer, 'Re - '.$tbpesancustomer->judul, $tbpesancustomer->pesanbalasan, $headers);
    }
    return ['tanggalbalasan' => $tbpesancustomer->tanggalbalasan];
  }
  public function hapusbalaspesan(Request $request) {
    TbPesanCustomer::find($request->pesanid)->delete();
    return 1;
  }
}
