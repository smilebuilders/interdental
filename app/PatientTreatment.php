<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class PatientTreatment extends Model
{
    use SoftDeletes;
    
    public function patient()
    {
      return $this->belongsTo('App\Patient');
    }
    
    public function claim()
    {
      return $this->belongsTo('App\Claim');
    }
   
    public function images() 
    {
      return $this->hasMany('App\TreatmentImage');
    } 

    public function treatment() 
    {
      return $this->belongsTo('App\Treatment');
    } 

    protected $fillable = ['number', 'sc', 'df', 'code', 'description', 'date', 'images', 'patient_id'];
    protected $table = 'patients_treatments';

    protected $dates = ['deleted_at'];
}
