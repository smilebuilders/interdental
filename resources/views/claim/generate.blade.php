@extends('layout.app')
@section('title', 'Generar Claim')

@section('content')
<h1>Generar Claim</h1>
<div class="card">
    <table class="table table-sm table-striped" style="background:#fff;">
        <tbody>
            <tr>
                <td>Nombre(s):</td>
                <td>{{$claim->patient->first_name}}</td>
            </tr>
            <tr>
                <td>Apellidos:</td>
                <td>{{$claim->patient->last_name}}</td>
            </tr>
            <tr>
                <td>Fecha de nacimiento</td>
                <td>{{$claim->patient->birth_date}}</td>
            </tr>
            <tr>
                <td>Género:</td>
                <td>{{$claim->patient->gender}}</td>
            </tr>
            <tr>
                <td>NS</td>
                <td>{{$claim->patient->nss}}</td>
            </tr>
            <tr>
                <td>Aseguradora:</td>
                <td>Aetna</td>
            </tr>
            
            <tr>
                <td>Compañia:</td>
                <td>{{$claim->patient->company}}</td>
            </tr>      
        </tbody>
    </table>
</div>

<div class="row">
    <claim-treatments-list v-bind:claim="{{$claim->id}}"></claim-treatments-list>
</div>

@endsection