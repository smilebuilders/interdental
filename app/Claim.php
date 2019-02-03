<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Claim extends Model
{
  protected $fillable = [
    'type_of_transaction',
    'remarks',
    'nea',
    'number_enclosures',
    'is_ortho',
    'is_ortho_date',
    'remaining',
    'replacement_prosthesis',
    'placement_date',
    'ssn',
    'npi',
    'address'   
  ];
  public function treatments()
  {
    return $this->hasMany('App\PatientTreatment');
  }

  public function patient() {
    return $this->belongsTo('App\Patient');
  }

  public static function pending() {
    $pendings = Claim::where('status', 'pending')->get();
    return count($pendings);
  }
}
