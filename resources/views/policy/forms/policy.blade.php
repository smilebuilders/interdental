@extends('layout.app')
@section('title', 'Editar Poliza')

@section('content')
  <form class="" action="{{ route('policy_update', [$policy->id]) }}" method="post">
  @csrf
  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <label>No. Id</label>
        <input class="form-control" id="code" name="code" type="text" value="{!! $policy->code !!}">
        <span class="text-danger">{{ $errors->first('first_name') }}</span>
      </div>
      <div class="form-group">
        <label>No. Grupo</label>
        <input class="form-control" id="group_code" name="group_code" type="text" value="{!! $policy->group_code !!}">
        <span class="text-danger">{{ $errors->first('group_code') }}</span>
      </div>
      <div class="form-group">
        <label>Fecha Efectiva</label>
        <input class="form-control" id="aniversary_date" name="aniversary_date" type="datetime" value="{!! $policy->aniversary_date !!}">
        <span class="text-danger">{{ $errors->first('birth_date') }}</span>
      </div>
      <div class="form-group">
        <label>Máximo Anual</label>
        <input class="form-control" id="family_max" name="family_max" type="text" value="{!! $policy->family_max !!}">
        <span class="text-danger">{{ $errors->first('company') }}</span>
      </div>
    </div>

    <div class="col-md-6">
      <div class="form-group">
        <label>Deducible Familiar</label>
        <input class="form-control" id="family_deductible" name="family_deductible" type="text" value="{!! $policy->family_deductible !!}">
        <span class="text-danger">{{ $errors->first('nss') }}</span>
      </div>
      <div class="form-group">
        <label>Máximo Individual</label>
        <input class="form-control" id="individual_maximum" name="individual_maximum" type="text" value="{!! $policy->individual_maximum !!}">
        <span class="text-danger">{{ $errors->first('policy_code') }}</span>
      </div>
      <div class="form-group">
        <label>Deducible Individual</label>
        <input class="form-control" id="individual_deductible" name="individual_deductible" type="text" value="{!! $policy->individual_deductible !!}">
        <span class="text-danger">{{ $errors->first('address') }}</span>
      </div>
      <div class="form-group">
        <label>Máximo Ortho Individual</label>
        <input class="form-control" id="individual_ortho_maximum" name="individual_ortho_maximum" type="text" value="{!! $policy->individual_ortho_maximum !!}">
        <span class="text-danger">{{ $errors->first('city') }}</span>
      </div>
    </div>
    <div class="col-sm-12 text-center btn-fix-bottom">
      <a class="btn btn-default" href="{{ route('policy', [$policy->patient->id]) }}">Cancelar</a>
      <input id="btnGuardar" type="submit" value="Guardar" class="btn btn-primary">
    </div>
  </div>
  </form>
@endsection
