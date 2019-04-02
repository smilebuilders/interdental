@extends('layout.app')
@section('title', 'Interdental Solution')
@section('content')
  
  <div id="new-patient" class="row">
    <div class="col-md-12 d-flex justify-content-between align-items-center">
      <h1>Listado de Pacientes</h1>
      <a class="btn btn-primary" href="{{ route('patient_create') }}" role="button">Agregar Paciente</a>
    </div>
  </div>


  <div class="row d-flex justify-content-between align-items-center mt-3">

    <form class="col-sm-6" action="{{route('patient_search')}}" method="get">
        <div class="input-group">
          <input type="text" class="form-control" placeholder="Nombre, Apellido" name="param">
          <button class="btn btn-primary ml-3" type="submit"><i class="fa fa-search"></i> Buscar</button>
        </div>
    </form>

    <ul class="list-unstyled list-inline pull-right">
      <li><strong>Descripción de estatus:</strong></li>

      <li class="list-inline-item"><div class="status-ok circle">✓</div></li>
      <li class="list-inline-item">Si</li>

      <li class="list-inline-item"><div class="status-no circle">✘</div></li>
      <li class="list-inline-item">No</li>

      <li class="list-inline-item"><div class="status-send circle">R</div></li>
      <li class="list-inline-item">En Revisión</li>

      <li class="list-inline-item"><div class="status-nd circle">N/D</div></li>
      <li class="list-inline-item">No Disponible</li>

      <li class="list-inline-item"><div class="status-claims circle">#</div></li>
      <li class="list-inline-item">De Claims</li>
    </ul>

    @include('layout.tables.search_patient')
  </div>
@endsection
