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
        $patient->user_id = $request->user()->id;
        $patient->save();

        Policy::create($patient);

        return redirect()->route('index')->with('message', 'Paciente creado correctamente');
    }

    public function edit($id)
    {
        // retorna la vista para editar paciente con los datos del paciente
        $patient = Patient::find($id);
        return view('policy.forms.patient')->with('patient', $patient);
    }
    
    public function update(StorePatient $request, $id)
    {
        // Se guardan los cambios en el paciente
        $patient = Patient::find($id);
        $patient->fill($request->all());
        $patient->save();

        $policy = $patient->policy;
        $policy->code = $patient->policy_code;
        $policy->save();

        return redirect()->route('policy_verify', ['id' => $request->id])->with('message', 'Paciente actualizado con éxito');
    }
    public function benefits($id)
    {
      $policy = Policy::where('patient_id', $id)->first();
      return view('patient.benefits')->with('policy', $policy);
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
