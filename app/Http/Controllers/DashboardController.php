<?php

namespace guialocaliza\Http\Controllers;

use Illuminate\Http\Request;

use guialocaliza\Http\Requests;
use guialocaliza\Http\Controllers\Controller;

class DashboardController extends Controller
{
    //
    public function index()
    {
      return  view('dashboard');
    }
}
