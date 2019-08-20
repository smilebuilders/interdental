<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Insurance extends Model
{

    public function patients()
    {
      return $this->hasMany('App\Patient');
    }

    public static function getInsurances() {
      $insurances = Insurance::orderBy('name', 'ASC')->get();
      return $insurances;
    }

}
