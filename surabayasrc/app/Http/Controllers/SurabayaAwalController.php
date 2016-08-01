<?php namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;

class SurabayaAwalController extends BaseController
{
    public function index() {
    	return view('populer');
    }
}
