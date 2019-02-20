@extends('layout.app')
@section('title', 'Claims generados')

@section('content')
  <h1>Claims Generados</h1>
  <div class="card">
    <table class="table table-sm table-striped" style="background:#fff;">
      <tbody>
        <tr>
          <td>Nombre(s):</td>
          <td>{{$patient->first_name}}</td>
        </tr>
        <tr>
          <td>Apellidos:</td>
          <td>{{$patient->last_name}}</td>
        </tr>
        <tr>
          <td>Fecha de nacimiento</td>
          <td>{{$patient->birth_date}}</td>
        </tr>
        <tr>
          <td>Género:</td>
          <td>{{$patient->gender}}</td>
        </tr>
        <tr>
          <td>NS</td>
          <td>{{$patient->nss}}</td>
        </tr>
        <tr>
          <td>Aseguradora:</td>
          <td>Aetna</td>
        </tr>

        <tr>
          <td>Compañia:</td>
          <td>{{$patient->company}}</td>
        </tr>
      </tbody>
    </table>
  </div>
  <div class="col-sm-12 text-small">
    <ul class="list-unstyled list-inline float-right">
      <li class="list-inline-item">
        <div class="status-claims circle">G</div>
      </li>
      <li class="list-inline-item">
        <strong>Generado</strong>
      </li>
      <li class="list-inline-item">
        <div class="status-send circle">E</div>
      </li>
      <li class="list-inline-item">
        <strong>Enviado</strong>
      </li>
      <li class="list-inline-item">
        <div class="status-ok circle">✓</div>
      </li>
      <li class="list-inline-item">
        <strong>Pagado</strong>
      </li>
      <li class="list-inline-item">
        <div class="status-partial circle">P</div>
      </li>
      <li class="list-inline-item">
        <strong>Parcial</strong>
      </li>
      <li class="list-inline-item">
        <div class="status-client circle">C</div>
      </li>
      <li class="list-inline-item">
        <strong>Pagado a Cliente</strong>
      </li>
      <li class="list-inline-item">
        <div class="status-no circle">✘</div>
      </li>
      <li class="list-inline-item">
        <strong>Rechazado</strong>
      </li>
    </ul>
  </div>
  <table class="table table-striped table-sm mt-5">
    <thead>
      <tr>
        <th>Código</th>
        <th>Fecha Creación</th>
        <th class="text-center">Estatus</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($patient->claimsCreated() as $claim)
        <tr>
          <td>
            <a class="btn btn-success btn-sm" href="{{ route('patient_show_claim', ['id' => $claim->id]) }}">
              {{$claim->code}}
            </a>
          </td>
          <td>{{\Carbon\Carbon::parse($claim->created_at)->format('m/d/Y')}}</td>
          <td class="text-center">
            @if ($claim->status == 'generated')
              <div class="status-claims circle">G</div>
            @elseif($claim->status == 'sent')
              <div class="status-send circle">E</div>
            @elseif($claim->status == 'paid')
              <div class="status-ok circle">✓</div>
            @elseif($claim->status == 'partial')
              <div class="status-partial circle">P</div>
            @elseif($claim->status == 'paid_client')
              <div class="status-client circle">C</div>
            @elseif($claim->status == 'rejected')
              <div class="status-no circle">✘</div>
            @endif

          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
@endsection
