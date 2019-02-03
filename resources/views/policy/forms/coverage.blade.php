@extends('layout.app')
@section('title', 'Editar covertura')

@section('content')
  <div class="row justify-content-md-center">
    <div class="col-sm-4">
      <h3 class="panel-title">Editar Cobertura</h3>
      <form class="" action="{{ route('policy_update', [$policy->id]) }}" method="post">
        {{ csrf_field() }}
        <label>Preventivo</label>
        <div class="input-group">
          <input class="form-control" name="preventivo" type="number" value="{!! $policy->preventivo !!}">
          <span class="input-group-addon">%</span>
        </div>

        <label>Básico</label>
        <div class="input-group">
          <input class="form-control" name="basico" type="number" value="{!! $policy->basico !!}">
          <span class="input-group-addon">%</span>
        </div>

        <label>Mayor</label>
        <div class="input-group">
          <input class="form-control" name="mayor" type="number" value="{!! $policy->mayor !!}">
          <span class="input-group-addon">%</span>
        </div>

        <label>Resinas</label>
        <div class="input-group">
          <input class="form-control" name="resinas" type="number" value="{!! $policy->resinas !!}">
          <span class="input-group-addon">%</span>
        </div>

        <label>Endo</label>
        <div class="input-group">
          <input class="form-control" name="endo" type="number" value="{!! $policy->endo !!}">
          <span class="input-group-addon">%</span>
        </div>

        <label>Perio</label>
        <div class="input-group">
          <input class="form-control" name="perio" type="number" value="{!! $policy->perio !!}">
          <span class="input-group-addon">%</span>

        </div>

        <label>Prótesis</label>
        <div class="input-group">
          <input class="form-control" name="protesis" type="number" value="{!! $policy->protesis !!}">
          <span class="input-group-addon">%</span>
        </div>

        <label>Implantes</label>
        <div class="input-group">
          <input class="form-control" name="implantes" type="number" value="{!! $policy->implantes !!}">
          <span class="input-group-addon">%</span>
        </div>

        <label>Ortho</label>
        <div class="input-group">
          <input class="form-control" name="ortho" type="number" value="{!! $policy->ortho !!}">
          <span class="input-group-addon">%</span>
        </div>

        <div class="text-center">
            <label class="btn btn-default">Cancelar</label></a>
            <input id="btnGuardar" type="submit" value="Guardar" class="btn btn-primary">
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
