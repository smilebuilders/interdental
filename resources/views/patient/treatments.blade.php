@extends('layout.app')
@section('title', 'Tratamientos')

@section('content')
<div class="new-patient row justify-content-md-end">
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addTreatment">
    Agregar Tratamiento
</button>
</div>
<h1>Tratamientos</h1>
<div class="card">
<div class="card-header">
    <h3 class="panel-title">Asegurado</h3>
</div>
    <table class="table table-sm table-striped" style="background:#fff;">
        <tbody>
            <tr>
                <td>Nombre(s):</td>
                <td>{!! $patient->first_name !!}</td>
            </tr>
            <tr>
                <td>Apellidos:</td>
                <td>{!! $patient->last_name !!}</td>
            </tr>
            <tr>
                <td>Fecha de nacimiento</td>
                <td>{!! $patient->birth_date !!}</td>
            </tr>
            <tr>
                <td>Género:</td>
                <td>{!! $patient->gender !!}</td>
            </tr>
            <tr>
                <td>NS</td>
                <td>{!! $patient->nss !!}</td>
            </tr>
            <tr>
                <td>Aseguradora:</td>
                <td>{!! $patient->ensurance !!}</td>
            </tr>
            <tr>
                <td>Compañia:</td>
                <td>{!! $patient->company !!}</td>
            </tr>

        </tbody>
    </table>
</div>
<treatments-list v-bind:patient="{{ $patient->id }}"></treatments-list>
{{-- @include('layout.modals.upload_image') --}}

{{-- Add treatment MODAL --}}
<add-treatment patient="{!! $patient->id !!}"/>
  @endsection
