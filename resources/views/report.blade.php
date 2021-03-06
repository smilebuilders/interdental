@extends('layout.app')
@section('content')
  <table class="table table-striped table-sm" style="font-size: 12px;" data-show-print="true">
    <thead>
      <tr>
        <th>Claim</th>
        <th>Fecha</th>
        <th>Estatus</th>
        <th>Paciente</th>
        <th>NSS</th>
        <th>ID</th>
        <th>FDN</th>
        <th>Aseguradora</th>
        <th>Tratamientos</th>
        <th>Fecha de envio</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($claims as $claim)
        <tr>
          <th><a href="{{ route('patient_show_claim', ['id' => $claim->id]) }}">{{ $claim->code }}</a></th>
          <th>{{ $claim->created_at->format('M d Y') }}</th>
          <th>{{ $claim->status }}</th>
          <th>{{ $claim->patient->first_name . ', ' . $claim->patient->last_name}}</th>
          <th>{{ $claim->patient->nss }}</th>
          <th>{{ $claim->patient->policy_code }}</th>
          <th>{{ $claim->patient->birth_date }}</th>
          <th>{{ $claim->patient->insurance->name }}</th>
          <th>
            @php
                $treatments = '';
              foreach($claim->treatments as $treatment) {
                $treatments = $treatments . $treatment->description . ', <br>';
              }
              echo $treatments;
            @endphp 
          </th>
          <th>{{ $claim->created_at->format('d M Y') }}</th>
        </tr>
      @endforeach
    </tbody>
  </table>
@endsection
