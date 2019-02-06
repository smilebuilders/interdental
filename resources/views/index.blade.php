@extends('layout.app')
@section('title', 'Ensurance')
@section('content')
  <div id="new-patient" class="row d-flex align-items-center">
    <div class="col-md-6">
      <h1>Listado de Pacientes</h1>
    </div>
    <div class="col-md-6">
      <a class="btn btn-primary float-right" href="{{ route('patient_create') }}" role="button">Agregar Paciente</a>
    </div>
  </div>

  <div id="search-patient" class="row">
    <form class="col-md-6" action="{{route('patient_search')}}" method="get">
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fa fa-search"></i></span>
        </div>
        <input type="text" class="form-control" placeholder="Buscar" name="param">
        <button class="btn btn-primary ml-3" type="submit">Buscar</button>
      </div>
    </form>
  </div> <!-- new and search patient -->

  <div class="patients-table row">
    <ul class="list-unstyled list-inline pull-right">
      <li><p>Descripción de estatus:</p></li>
      <li class="list-inline-item">
        <div class="status-ok circle">✓</div>
      </li>
      <li class="list-inline-item">
        <strong>Si</strong>
      </li>
      <li class="list-inline-item">
        <div class="status-no circle">✘</div>
      </li>
      <li class="list-inline-item">
        <strong>No</strong>
      </li>
      <li class="list-inline-item">
        <div class="status-send circle">R</div>
      </li>
      <li class="list-inline-item">
        <strong>En Revisión</strong>
      </li>

      <li class="list-inline-item"><div class="status-nd circle">N/D</div></li>
      <li class="list-inline-item"><strong>No Disponible</strong></li>
      <li class="list-inline-item"><div class="status-claims circle">#</div></li>
      <li class="list-inline-item"><strong>De Claims</strong></li>


    </ul>
    <table class="table table-striped table-condensed">
      <thead>
        <tr class="head-row">

          <td colspan="4"><strong>INFORMACION DE PACIENTE</strong></td>
          <td colspan="3"><strong>ESTATUS</strong></td>
          <td colspan="3"><strong>DETALLE </strong></td>

        </tr>
        <tr class="th-list">
          <th style="width: 20%">
            <label>Nombre</label>
          </th>
          <th style="width: 10%">
            <label>NSS</label>
          </th>
          <th style="width: 10%">
            <label>FDN</label>
          </th>
          <th style="width: 10%">
            <label>Aseguradora</label>
          </th>
          <th style="width: 10%" class="text-center">
            <label>Asegurado</label>
          </th>
          <th style="width: 10%" class="text-center">
            <label>Verificado</label>
          </th>
          <th style="width: 10%" class="text-center">
            <label>Claim</label>
          </th>
          <th style="width: 10%" class="text-center">
            <label>Tratamientos</label>
          </th>
          <th style="width: 10%" class="text-center">
            <label>Beneficios</label>
          </th>
        </tr>
      </thead>
      <tbody>
        @if (isset($patients))
          @foreach ($patients as $patient)
              <tr>
              <td>{!! $patient->first_name . ' ' . $patient->last_name !!}</td>
              <td>{!! $patient->nss !!}</td>
              <td>{!! $patient->birth_date !!}</td>
              <td>{!! $patient->ensurance !!}</td>
              <td>
                @if (isset($patient->policy))
                  @if ($patient->policy->status == 1)
                    <div class="status-send circle">R</div>
                  @elseif($patient->policy->status == 2)
                    <div class="status-ok circle">✓</div>
                  @elseif($patient->policy->status == 3)
                    <div class="status-no circle">✘</div>
                  @endif
                @endif
              </td>
              <td>
                @if (isset($patient->policy))
                  @if ($patient->policy->verified == 1)
                    <div class="status-send circle">R</div>
                  @elseif($patient->policy->verified == 2 || $patient->policy->verified == 3)
                    <div class="status-ok circle">✓</div>
                  @endif
                @endif
              </td>
              <td>
                <a class="text-white" href="{{route('patient_claims',[$patient->id])}}">
                  <div class="status-claims circle">
                    {{count($patient->claimsCreated())}}
                  </div>
                </a>
              </td>
              <td> 
                <a class="btn btn-success" href="{{ route('patient_treatments', [$patient->id]) }}"><span class="fa fa-search"></span></a> 
              </td>
              <td>
                  <a class="btn btn-success" href="{{ route('patient_benefits', $patient->id) }}"><span class="fa fa-search"></span></a>
              </td>
            </tr>
          @endforeach
        @else
          <tr>
            <td colspan="9" class="text-center">
              <label class="alert alert-danger">No se encontraron resultados</label>
            </td>
          </tr>
        @endif
      </tbody>
    </table>
  </div>
@endsection
