<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\PatientTreatment;
use App\TreatmentImage;
use App\Treatment;
use App\Claim;
use Auth;
use Image;

class treatmentController extends Controller
{
  
  public function store(Request $request) {
    try {
      $treatment = new PatientTreatment;
      $treatment->fill($request->all()); 
      $treatment->save();
      return $treatment;
    } catch(\Exception $e) {
      return $e->getMessage();
    }    
  }
        
  public function delete($id) {
    try {
      $treatment = PatientTreatment::where('id', $id);
      $treatment->delete();
      return response()->json(['message' => 'Tratamiento eliminado'], 200);
      } catch(\Exception $e) {
        return $e->getMessage();
     }
  }
      
  public function send(Request $request) {
    try {
      $claim = new Claim;
      $claim->code = time();
      $claim->patient_id = $request->patient;
      $claim->user_id = Auth::user()->id;
      $claim->save();
      
      $treatments = PatientTreatment::find($request->treatments);
      
      foreach($treatments as $treatment) {
        $treatment->status = 'r';
        $treatment->claim_id = $claim->id;
        $treatment->save();
        };
        
        return response()->json(['msg' => 'Enviado'], 200);
      } catch(\Exception $e) {
      return $e->getMessage();
    }
  }
          
  // subir imagenes a un tratamiento
  public function uploadImage(Request $request) {
    if($request->hasFile('image')) {
      foreach ($request->image as $image) {
        $filename = substr(number_format(time() * rand(),0,'',''),0,10) . '.' . $image->getClientOriginalExtension();
        $img = Image::make($image);
        Storage::disk('spaces')->put('uploads/' . $filename, $img->stream(), 'public');
  
        $img = new TreatmentImage;
        $img->patient_treatment_id = $request->treatment_id;
        $img->filename = $filename;
        $img->save();
      }
    }
      return back();
  }
  // eliminar imagen de tratamiento
  public function deleteImage(Request $request) {
    try {
      $img = TreatmentImage::find($request->image_id);
      Storage::disk('spaces')->delete('uploads/' . $img->filename);
      $img->delete();
      return response()->json(['message' => 'image-deleted'], 200);
    } catch(\Exception $e) {
      return $e->getMessage();
    }
    
  }

  public function getGeneratedTreatments($id) {
    $treatments = PatientTreatment::where('patient_id', $id)
    ->where('status', '')
    ->orWhere('status', 'r')
    ->get();
    return $treatments;
  }
    
  public function getCategoryTreatments($category) {
    try {
      $treatments = Treatment::where('category', $category)->get();
      return response()->json($treatments, '200');
    } catch (\Exception $e) {
      return $e->getMessage();
    }
  }

  public function getTreatment($id) {
    $treatment = PatientTreatment::find($id);
    $images = $treatment->images()->get();
    return($images);
  }

}
  