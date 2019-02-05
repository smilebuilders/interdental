<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Patient;
use App\Claim;
use Auth;

class indexController extends Controller
{
    // redirect to index
    public function index() {
      return view('index');
    }

    // search patients
    public function search(Request $request)
    {
      global $param;
      $param = $request->param;
      $patients = Patient::where('user_id', Auth::user()->id)
      ->where(function($query) {
        $query->where('first_name', $GLOBALS['param'])
              ->orWhere('last_name', $GLOBALS['param']);
      })->get();

      return view('index')->with('patients', $patients);
    }

    // redirect to report
    public function report()
    {
      $claims = Claim::all();
      return view('report')->with('claims', $claims);
    }
}
