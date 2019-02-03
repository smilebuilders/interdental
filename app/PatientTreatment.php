<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PatientTreatment extends Model
{
    public function patient()
    {
      return $this->belongsTo('App\Patient');
    }
    public function claim()
    {
      return $this->belongsTo('App\Claim');
    }
    protected $fillable = ['number', 'sc', 'df', 'code', 'description', 'date', 'images', 'patient_id'];
    protected $table = 'patients_treatments';
}
