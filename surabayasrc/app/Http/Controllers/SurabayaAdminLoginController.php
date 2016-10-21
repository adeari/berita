<?php namespace App\Http\Controllers;

use App\Http\Controllers\MasterController;
use Illuminate\Http\Request;

use App\tables\TbBerita;
use App\tables\TbKomentar;

use URL;
use Auth;
use App\User;

class SurabayaAdminLoginController extends MasterController
{
  public function __construct()
  {
    $this->middleware('auth');
  }
  public function berita() {
    return view('admin.berita');
  }
  public function beritatable(Request $request) {
    $limit = 9;
    $page = 0;
    if ($request->pagego) {
      $page = (intval($request->pagego) - 1) * $limit;
    }
    $totalberita = TbBerita::count();
    $datatbberita = TbBerita::skip($page)->take($limit)->get();
    $beritas = [];
    foreach ($datatbberita as $databerita) {
      $beritas[] = [
      	'id' => $databerita->id,
      	'judul' => $databerita->judul,
      	'jumlah_komentar' => $databerita->jumlah_komentar,
      	'jumlah_share' => $databerita->jumlah_share,
      ];
    }
    $totalpage = floor($totalberita / $limit);
    if ($totalberita % $limit > 0) {
      $totalpage++;
    }
    return [
      'beritas' => $beritas,
      'totalberita' => $totalberita,
      'totalpage' => $totalpage,
    ];
  }
}
