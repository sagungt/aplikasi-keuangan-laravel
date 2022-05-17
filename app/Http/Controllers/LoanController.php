<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoanController extends Controller
{
    public function request()
    {
        return view('dashboard.loan.request');
    }
}
