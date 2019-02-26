@extends('layout.app')
@section('title', 'Editar Beneficios')

@section('content')
<div class="row justify-content-md-center">
  <div class="col-sm-4">
    <h3 class="panel-title">Editar Ortho</h3>
    <form class="form" action="{{ route('remaining_benefits_update') }}" method="post">
      {{ csrf_field() }}
      <div class="form-group">
        <label>{{$policy->patient->first_name}}, {{$policy->patient->last_name}}</label>
        <input class="form-control" name="benefits[{{$policy->patient->id}}]" type="text" value="{{$policy->patient->remaining_benefits}}">
      </div>

      @foreach ($policy->patient->dependents($policy->patient->id) as $dependent)
        <div class="form-group">
          <label for="">{{$dependent->first_name}}, {{$dependent->last_name}}</label>
          <input class="form-control" name="benefits[{{$dependent->id}}]" type="text" value="{{$dependent->remaining_benefits}}">
        </div>
      @endforeach

      <div class="text-center">
          <label class="btn btn-default">Cancelar</label></a>
          <input id="btnGuardar" type="submit" value="Guardar" class="btn btn-primary">
      </div>
    </form>
  </div>
</div>
@endsection