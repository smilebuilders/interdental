<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{

  public function policy()
  {
    return $this->hasOne('App\Policy');
  }

  public function insurance()
  {
    return $this->belongsTo('App\Insurance');
  }

  public function treatments()
  {
    return $this->hasMany('App\PatientTreatment');
  }

  public function claims()
  {
    return $this->hasMany('App\Claim');
  }


  protected $fillable = [
    'first_name',
    'last_name',
    'birth_date',
    'gender',
    'company',
    'nss',
    'policy_code',
    'address',
    'city',
    'state',
    'zip_code',
    'phone',
    'insurance_id',
    'relation'
  ];

  public function claimsCreated() {
      $claims = [];
    foreach ($this->claims as $claim) {
        if($claim->status != 'pending'){
            array_push($claims, $claim);
        }
    }
      return $claims;
  }

  public function dependents($id)
  {
    $dependents = Patient::where('patient_id', $id)->get();
    return $dependents;
  }
}
