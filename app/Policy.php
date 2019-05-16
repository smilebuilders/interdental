<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Policy extends Model
{
  protected $guard = ['id','patient_id'];

  public function patient()
  {
    return $this->belongsTo('App\Patient');
  }

  public static function pending() {
    if(Auth::check()) {
      $pending = Policy::where('verified', 1)->where('user_id', Auth::user()->id)->get();
      $number = count($pending);
      return $number;
    }
  }

  public static function create($patient) {
    $policy = new Policy();
    $policy->code = $patient->policy_code;
    $policy->patient_id = $patient->id;
    $policy->user_id = Auth::user()->id;
    $policy->save();
  } 
}
