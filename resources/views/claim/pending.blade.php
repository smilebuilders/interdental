@extends('layout.app')
@section('title', 'Claims Pendientes')

@section('content')
<h1>Claims Pendientes</h1>
<div class="row">
    <table class="table table-striped table-condensed">
        <thead>
            <tr class="th-listado">
                <th style="width: 20%">Nombre</th>
                <th style="width: 10%">NSS</th>
                <th style="width: 10%">FDN</th>
                <th style="width: 10%">Aseguradora</th>
                <th style="width: 10%">Claim</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($claims as $claim)
            <tr>
                <td>{{ $claim->patient->first_name }}, {{ $claim->patient->last_name }}</td>
                <td>{{ $claim->patient->nss }}</td>
                <td>{{ $claim->patient->birth_date }}</td>
                <td>{{ $claim->patient->ensurance }}</td>
                <td>
                <a class="btn btn-success btn-sm" href="{{ route('claim_generate', [$claim->id]) }}">Generar</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection