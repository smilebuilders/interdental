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
    public function getCategoryTreatments($category) {
      try {
        $treatments = Treatment::where('category', $category)->get();
        return response()->json($treatments, '200');
      } catch (\Exception $e) {
        return $e->getMessage();
      }
    }

    /**
     * retorna la lista de tratamientos creados
     * o enviados a revisar para claim del paciente
     */
    public function get($id) {
        $treatments = PatientTreatment::where('patient_id', $id)->where('status', '')->orWhere('status', 'r')->get();
        return $treatments;
    }

    public function post(Request $request) {
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

    /**
     * se envia el tratamiento para revicion de claim
     * se le asigna el status 'r' al tratamiento, se cra nuevo claim
     * y se le asignan los tratamientos enviados
     */
    public function send(Request $request) {
        try {
            $claim = new Claim;
            $claim->code = time();
            $claim->patient_id = $request->patient;
            $claim->user_id = Auth::user()->id;
            $claim->save();
            // return $claim;
            $treatments = PatientTreatment::find($request->treatments);
            foreach($treatments as $treatment) {
                $treatment->status = 'r';
                $treatment->claim_id = $claim->id;
                $treatment->save();
            }
            return response()->json(['msg' => 'Enviado'], 200);
        } catch(\Exception $e) {
            return $e->getMessage();
        }
    }

    // subir imagenes a un tratamiento
    public function uploadImage(Request $request) {
      if($request->hasFile('image')) {
        foreach ($request->image as $image) {
          $filename = time() . '.' . $image->getClientOriginalExtension();
          Image::make($image)->save(public_path('uploads/'.$filename));
          $thumb = Image::make($image);
          $thumb->save(public_path('uploads/thumbs/'.$filename));

          $img = new TreatmentImage;
          $img->patient_id = $request->patient_id;
          $img->filename = $filename;
          $img->save();
        }
      }
      return back();
    }
    // eliminar imagen de tratamiento
    public function deleteImage(Request $request) {
      $img = TreatmentImage::find($request->image_id);
      \File::delete(public_path('uploads/'.$img->filename));
      \File::delete(public_path('uploads/thumbs/'.$img->filename));
      
      $img->delete();
      return back();
    }
}
