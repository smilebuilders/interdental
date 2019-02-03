<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Claim;
class indexController extends Controller
{
    // redirect to index
    public function index() {
      return view('index');
    }

    // redirect to report
    public function report()
    {
      $claims = Claim::all();
      return view('report')->with('claims', $claims);
    }
}
