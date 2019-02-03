@extends('layout.app')
@section('title', 'Beneficios')

@section('content')
  <h1>Beneficios del Paciente</h1>
  <?php // TODO: display status ?>
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
@endsection
