<?php namespace App\Http\Controllers;

use App\Http\Controllers\MasterController;
use Illuminate\Http\Request;

class CobaController extends MasterController
{
  public function cobaan() {
    return view('coba.cobaan');
  }
}
