<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dependent;
use App\Patient;

class dependentController extends Controller
{
    public function create($id) {
      $patient = Patient::find($id);
      return view('policy.forms.dependent')->with('patient', $patient);
    }

    public function store(Request $request) {
      // dd($request->patient_id);
      $patient = Patient::find($request->patient_id);
      $dependent = new Patient;
      $dependent->fill($request->all());
      $dependent->insurance_id = $patient->insurance_id;
      $dependent->user_id = $request->user()->id;
      $dependent->patient_id = $request->patient_id;
      $dependent->save();

      return back();
    }
}
