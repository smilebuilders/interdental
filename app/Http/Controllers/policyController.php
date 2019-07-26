<?php

namespace App\Http\Controllers;

use App\Policy;
use Illuminate\Http\Request;
use Auth;
class policyController extends Controller
{
    
    public function verify($id)
    {
        $policy = Policy::where('patient_id', $id)->first();
        return view('policy.verify')->with('policy', $policy);
    }

    
    public function pendingVerification()
    {
        // retorna las polizas pendientes de verificar
        $policies = Policy::where('verified', 1)->where('user_id', Auth::user()->id)->get();
        return view('policy.pending_verification')->with('policies', $policies);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Policy  $policy
     * @return \Illuminate\Http\Response
     */
    public function show(Policy $policy)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Policy  $policy
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $policy = Policy::find($id);
        return view('policy.forms.policy')->with('policy',$policy);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Policy  $policy
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $policy = Policy::find($id);
        $policy->fill($request->all());
        $policy->save();

        $patient = $policy->patient;
        $patient->policy_code = $policy->code;
        $patient->save();

        return redirect()->route('policy_verify',[$policy->patient_id])->with('message', 'Poliza actualizada con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Policy  $policy
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function coverage($id) {
      $policy = Policy::find($id);
      return view('policy.forms.coverage')->with('policy', $policy);
    }
    public function extraCoverage($id) {
      $policy = Policy::find($id);
      return view('policy.forms.extra_coverage')->with('policy', $policy);
    }
    public function benefits($id) {
      $policy = Policy::find($id);
      return view('policy.forms.benefits')->with('policy', $policy);
    }

    public function changeStatus(Request $request) {
        try {
            $policy = Policy::find($request->policy);
            $policy->verified = $request->status;
            $policy->status = $request->status;
            $policy->save();
            return response()->json(['msg'=>'status cambiado'], 200);
        } catch(\Exception $e) {
            $e->getMessage();
        }
    }

}
