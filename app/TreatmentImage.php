<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TreatmentImage extends Model
{
  public function treatment()
    {
      return $this->belongsTo('App\PatientTreatment');
    }
}
