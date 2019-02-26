<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StorePatient;
use App\Patient;
use App\Policy;
use App\Claim;
use Auth;
class patientController extends Controller
{
  
    public function create()
    {
        // show create user form view
        return view('patient.create');
    }

    public function store(StorePatient $request)
    {
        // store patient
        $patient = new Patient;
        $patient->fill($request->all());
        $patient->user_id = $request->user()->id;
        $patient->save();

        $policy = new Policy();
        $policy->code = $patient->policy_code;
        $policy->patient_id = $patient->id;
        $policy->user_id = $request->user()->id;
        $policy->save();


        return redirect()->route('index')->with('message', 'Paciente creado correctamente');
    }

    public function benefits($id)
    {
      $policy = Policy::where('patient_id', $id)->first();
      return view('patient.benefits')->with('policy', $policy);
    }

    public function edit($id)
    {
        //
        $patient = Patient::find($id);
        return view('policy.forms.patient')->with('patient', $patient);
    }

    public function update(StorePatient $request, $id)
    {
      dd($request);
        $patient = Patient::find($id);
        $patient->fill($request->all());
        $patient->save();
        return redirect()->route('policy', [$id]);
    }

    public function editBenefits($id) {
      $policy = Policy::find($id);
      return view('policy.forms.benefits')->with('policy', $policy);
    }

    public function updateBenefits(Request $request) {
      foreach ($request->benefits as $patient_id=>$value ) {
        $patient = Patient::find($patient_id);
        $patient->remaining_benefits = $value;
        $patient->save();
      }
      return back();
    }

    public function editOrtho($id) {
      $policy = Policy::find($id);
      return view('policy.forms.ortho')->with('policy', $policy);
    }

    public function updateOrtho(Request $request) {
      foreach ($request->ortho as $patient_id=>$value ) {
        $patient = Patient::find($patient_id);
        $patient->remaining_ortho = $value;
        $patient->save();
      }
      return back();
    }

    public function destroy($id)
    {
        $patient = Patient::find($id);
        $patient->delete();
        return back();
    }

    public function treatments($id)
    {
      $patient = Patient::find($id);
      return view('patient.treatments')->with('patient',$patient);
    }

}
