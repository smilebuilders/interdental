<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Policy extends Model
{
    public function patient()
    {
      return $this->belongsTo('App\Patient');
    }

    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
      'code',
      'group_code',
      'aniversary_date',
      'family_max',
      'family_deductible',
      'individual_maximum',
      'individual_deductible',
      'individual_ortho_maximum',
      'limit_age',
      'limit_age_text',
      'verified',
      'preventivo',
      'basico',
      'mayor',
      'resinas',
      'endo',
      'perio',
      'protesis',
      'implantes',
      'ortho',
      'rayosx',
      'limpieza',
      'flour',
      'coronas',
      'selladores',
      'extracciones_previas',
      'comments',
    ];

    public static function pending() {
      if(Auth::check()) {
        $pending = Policy::where('verified', 1)->where('user_id', Auth::user()->id)->get();
        $number = count($pending);
        return $number;
      }
    }
}
