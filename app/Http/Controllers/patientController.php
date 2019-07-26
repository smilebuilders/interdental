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
        return view('patient.create');
    }

    public function store(StorePatient $request)
    {
        $patient = new Patient;
        $patient->fill($request->all());
        $patient->user_id = Auth::user()->id;
        $patient->save();
        Policy::create($patient);

        return redirect()->route('index')->with('message', 'Paciente creado correctamente');
    }

    public function edit(Patient $patient)
    {
        return view('policy.forms.patient', compact('patient'));
    }
    
    public function update(StorePatient $request, Patient $patient)
    {
        $patient->fill($request->all());
        $patient->save();

        $policy = $patient->policy;
        $policy->code = $patient->policy_code;
        $policy->save();

        return redirect()->route('policy_verify', ['id' => $policy->patient_id])->with('message', 'Paciente actualizado con éxito');
    }

    public function benefits($id)
    {
        $policy = Policy::where('patient_id', $id)->first();
        
        return view('patient.benefits', compact('policy'));
    }

    public function editBenefits($id)
    {
        $policy = Policy::find($id);

        return view('policy.forms.benefits')->with('policy', $policy);
    }

    public function updateBenefits(Request $request)
    {
        foreach ($request->benefits as $patient_id=>$value) {
            $patient = Patient::find($patient_id);
            $patient->remaining_benefits = $value;
            $patient->save();
        }

        return back();
    }

    public function editOrtho($id)
    {
        $policy = Policy::find($id);

        return view('policy.forms.ortho')->with('policy', $policy);
    }

    public function updateOrtho(Request $request)
    {
        foreach ($request->ortho as $patient_id=>$value) {
            $patient = Patient::find($patient_id);
            $patient->remaining_ortho = $value;
            $patient->save();
        }

        return back();
    }

    public function destroy($id)
    {
        $patient = Patient::find($id);
        
        foreach ($patient->dependents($id) as $dependent) {
          $dependent->delete();
        }

        $patient->delete();

        return redirect('/');
    }

    public function treatments($id)
    {
        $patient = Patient::find($id);

        return view('patient.treatments')->with('patient', $patient);
    }
}
