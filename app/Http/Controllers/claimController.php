<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PatientTreatment;
use App\Patient;
use App\Claim;

class claimController extends Controller
{
  /**
  * retorna la vista de claims pendientes
  * y envia los claims con status 'pending'
  */
  public function pending() {
    $claims = Claim::where('status', 'pending')->get();
    return view('claim.pending')->with('claims', $claims);
  }

  /**
  * obtiene el id del claim a crear por parametro
  * retorna la vista para generar un claim
  */
  public function generate($id) {
    $claim = Claim::find($id);
    return view('claim.generate')->with('claim', $claim);
  }

  /**
  * retorna los tratamientos del claim recivido por parametro
  * con status 'r' (en revicion)
  */
  public function getTreatments($id) {
    try {
      $treatments = PatientTreatment::where('claim_id', $id)->where('status', 'r')->get();
      return $treatments;
    } catch(\Exception $e) {
      return $e->getMessage();
    }
  }

  /**
  * recive un array de tratamientos y el id del claim
  * cambia el status de los tratamientos a 'claim'
  * y el claim a "generated"
  */
  public function generateClaim(Request $request) {
    try {
      $treatments = PatientTreatment::find($request->treatments);
      foreach($treatments as $treatment) {
        $treatment->status = 'claim';
        $treatment->save();
      }
      $claim = Claim::find($request->claim);
      $claim->status = 'generated';
      $claim->save();
      return response()->json(['msg' => 'Claim creado'], 200);
    } catch(\Exception $e) {
      return $e->getMessage();
    }
  }

  public function generated($id) {
    $patient = Patient::find($id);
    return view('patient.claims')->with('patient', $patient);
  }

  public function show($id) {
    $claim = Claim::find($id);
    return view('claim.show')->with('claim', $claim);
  }

  public function update(Request $request) {
    $claim = Claim::find($request->id);
    $claim->fill($request->all());
    $claim->save();
    return back();
  }

  public function changeStatus(Request $request) {
    $claim = Claim::find($request->claim);
    $claim->status = $request->status;
    $claim->save();
    

    return back()->with('message', 'Etado del claim actualizado');
  }

}
