<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ajaxController extends Controller
{
    public function updatePrice(Request $request) {
      try {
        $treatment = \App\PatientTreatment::find($request->id);
        $treatment->price = $request->price;
        $treatment->save();
        return $treatment;
      } catch (\Exception $e) {
        return $e->getMessage();
      }
    }
}
