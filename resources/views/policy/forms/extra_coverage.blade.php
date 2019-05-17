@extends('layout.app')
@section('title', 'Extra Covertura')

@section('content')
  <div class="row justify-content-md-center">
  <div class="col-sm-6">
    <h3 class="panel-title">Editar Extra Cobertura</h3>
    <form class="" action="{{ route('policy_update', ['id' => $policy->id]) }}" method="post">
      {{ csrf_field() }}
    <div class="form-group">
      <label>Rayos X / Panorámica </label>
      <input class="form-control datefield" name="rayosx"  type="text" value="{{ $policy->rayosx }}">
    </div>
    <div class="form-group">
      <label>Limpieza / Prophy</label>
      <input class="form-control datefield" name="limpieza" type="text" value="{{ $policy->limpieza }}">
    </div>
    <div class="form-group">
      <label>Aplicación de Flour</label>
      <input class="form-control datefield" name="flour" type="text" value="{{ $policy->flour }}">
    </div>
    <div class="form-group">
      <label>Reemplazo de Coronas</label>
      <input class="form-control datefield" name="coronas" type="text" value="{{ $policy->coronas }}">
    </div>
    <div class="form-group">
      <label>Selladores</label>
      <input class="form-control datefield" name="selladores" type="text" value="{{ $policy->selladores }}">
    </div>
    <div class="form-group">
      <label>¿Cubre Prótesis en extracciones previas?</label><br>
      <input id="previusExtractions" type="checkbox"
      @if ($policy->extracciones_previas == 'true')
        checked
      @endif
      v-on:click="validatePreviusExtractions">

      <input type="hidden" name="extracciones_previas" v-model="previusExtractions">
    </div>
    <a class="btn btn-default" href="{{ route('policy_verify', [$policy->patient_id]) }}">Cancelar</a>
    <input id="btnGuardar" type="submit" value="Guardar" class="btn btn-primary">
  </form>
</div>
</div>
@endsection
