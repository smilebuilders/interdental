@extends('layout.app')
@section('title', 'Detalles de Poliza')

@section('content')
  <div class="row">
    <div class="col-md-6">
      <h1>Detalle del Paciente</h1>

    </div>

    <div class="col-sm-6 form-inline text-right">
    <policy-change-status v-bind:policy="{{$policy->id}}" v-bind:status="{{$policy->verified}}"></policy-change-status>
      <a class="btn btn-primary ml-2" href="{{ route('patient_claims', ['id' => $policy->patient->id])}}">
        <span>Claims</span>
      </a>
    </div>
  </div>

  <div class="row">
    <div class="col-sm-6">
      @include('policy.cards.patient')
    </div>
    <div class="col-sm-6">
      @include('policy.cards.policy')
    </div>
    <div class="col-sm-6">
      @include('policy.cards.coverage')
    </div>
    <div class="col-sm-6">
      @include('policy.cards.extra_coverage')
    </div>
    <div class="col-sm-6">
      @include('policy.cards.comments', ['patient' => $policy->patient])
    </div>
    <div class="col-sm-6">
      @include('policy.cards.benefits')
      @include('policy.cards.ortho')
    </div>
    <div class="col-sm-12">
      @include('policy.cards.dependents')
    </div>
  </div>

  <form action="{{ route('patient_delete', ['id' => $policy->patient->id]) }}" method="POST">
    @csrf
    <input class="btn btn-danger float-right" type="submit" value="Delete">
  </form>
@endsection
