@extends('layout.app')
@section('title', 'Verificaciones Pendientes')

@section('content')
<h1>Verificaciones Pendientes</h1>
<table id="myTable" class="table table-striped table-condensed">
    <thead>
        <tr class="th-listado">
            <th style="width: 30%">Nombre</th>
            <th style="width: 30%">Ultima verificación</th>
            <th style="width: 20%">Fecha Solicitado</label></th>
            <th style="width: 20%" class="text-center">Dentista</label></th>
        </tr>
    </thead>    
      
    <tbody>
    @foreach($pending as $policy)
        <tr>
            <td><a href="{{ route('policy', [$policy->id]) }}">{!! $policy->patient->first_name !!}</a></td>
            <td>N/D</td>
            <td>{!! $policy->created_at->diffForHumans() !!}</td>
            <td class="text-center">Ricardo  J. Guevara</td>
        </tr>
    @endforeach
    </tbody>
</table>
@endsection
