@extends('layout.app')
@section('title', 'Editar Beneficios')

@section('content')
<div class="row justify-content-md-center">
  <div class="col-sm-4">
    <h3 class="panel-title">Editar Ortho</h3>
    <form class="form" action="{{ route('remaining_ortho_update') }}" method="post">
      {{ csrf_field() }}
      <div class="form-group">
        <label>{{$policy->patient->first_name}}, {{$policy->patient->last_name}}</label>
        <input class="form-control" name="ortho[{{$policy->patient->id}}]" type="text" value="{{$policy->patient->remaining_ortho}}">
      </div>

      @foreach ($policy->patient->dependents($policy->patient->id) as $dependent)
        <div class="form-group">
          <label for="">{{$dependent->first_name}}, {{$dependent->last_name}}</label>
          <input class="form-control" name="ortho[{{$dependent->id}}]" type="text" value="{{$dependent->remaining_ortho}}">
        </div>
      @endforeach

      <div class="text-center">
          <a class="btn btn-default" href="{{ route('policy_verify', [$policy->patient_id]) }}">Regresar</a>
          <input id="btnGuardar" type="submit" value="Guardar" class="btn btn-primary">
      </div>
    </form>
  </div>
</div>
@endsection