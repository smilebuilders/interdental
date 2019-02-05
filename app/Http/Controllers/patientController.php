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

    public function showClaim($id)
    {
        $claim = Claim::find($id);
        return view('claim.show')->with('claim', $claim);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // show create user form view
        return view('patient.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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


        return redirect()->route('index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $patient = Patient::find($id);
        return view('policy.forms.patient')->with('patient', $patient);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StorePatient $request, $id)
    {
        //
        $patient = Patient::find($id);
        $patient->fill($request->all());
        $patient->save();
        return redirect()->route('policy', [$id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function treatments($id)
    {
      $patient = Patient::find($id);
    //   dd($patient->treatments);
      return view('patient.treatments')->with('patient',$patient);
    }

}
