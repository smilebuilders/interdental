@extends('layout.app')
@section('content')
  <table class="table table-striped table-sm">
    <thead>
      <tr>
        <th>Claim</th>
        <th>Fecha</th>
        <th>Servicio</th>
        <th>Estatus</th>
        <th>Paciente</th>
        <th>NSS</th>
        <th>ID</th>
        <th>FDN</th>
        <th>Fecha servicio</th>
        <th>Aseguradora</th>
        <th>Tratamientos</th>
        <th>Fecha de envio</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($claims as $claim)
        <tr>
          <th>{{ $claim->code }}</th>
          <th>{{ $claim->code }}</th>
          <th>{{ $claim->code }}</th>
          <th>{{ $claim->status }}</th>
          <th>{{ $claim->patient->first_name }}</th>
          <th>{{ $claim->patient->nss }}</th>
          <th>{{ $claim->patient->policy_code }}</th>
          <th>{{ $claim->patient->birth_date }}</th>

        </tr>
      @endforeach
    </tbody>
  </table>
@endsection
