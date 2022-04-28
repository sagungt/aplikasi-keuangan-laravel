<?php

namespace App\Http\Controllers;

class TestController extends Controller {
  public function index()
  {
    return view('test');
  }

  public function dashboard()
  {
    return view('dashboard.index');
  }
}