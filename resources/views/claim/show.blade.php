@extends('layout.app')
@section('title', 'Ver Claim')

@section('content')
  <h1>Ver Claim</h1>
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
    <div class="col-sm-12">
      <h3 class="mb-3">Claim: <span class="text-success">{{$claim->code}}</span></h3>
      <button class="btn btn-primary" data-toggle="modal" data-target="#infoClaim">Info Claim</button>
      <button class="btn btn-primary" data-toggle="collapse" data-target="#claimConfig">Configurar Claim</button>
      <button class="btn btn-primary" @if ($claim->type_of_transaction == null)disabled @endif>Claim</button>
    </div>
  </div>

  <div class="row mt-3">
      <div class="collapse col-md-12 p-3" id="claimConfig">
        <form class="row" action="{{route('claim_update')}}" method="post">
          {{ csrf_field() }}
          <div class="col-md-4 form-group">
            <label for="">Name, Address, City, State, ZipCode</label>
            <textarea class="form-control" name="address" cols="50">{{ $claim->address }}</textarea>
          </div>

          <div class="col-md-4 form-group">
            <label for="">NPI</label>
            <input class="form-control" name="npi" type="text" value="{{ $claim->npi }}" style="width:100">
          </div>

          <div class="col-md-4 form-group">
            <label for="">SSN or TIN</label>
            <input class="form-control" name="ssn" type="text" value="{{ $claim->ssn }}" style="width:100">
          </div>
          <div class="col-md-12">
            <button class="btn btn-success float-right" type="submit" name="button">Guardar</button>
          </div>
          <input type="hidden" name="id" value="{{ $claim->id }}">
        </form>
      </div>
  </div>

  <table class="table table-striped">
    <thead class="th-listado">
      <tr>
        <th>Number</th>
        <th>S / C</th>
        <th>D.F.</th>
        <th># Código</th>
        <th>Descripción del Tratamiento</th>
        <th>Fecha</th>
        <th>Imagen</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($claim->treatments as $treatment)
        @if ($treatment->status == 'claim')
          <tr>
            <td>{{$treatment->number}}</td>
            <td>{{$treatment->sc}}</td>
            <td>{{$treatment->df}}</td>
            <td>{{$treatment->code}}</td>
            <td>{{$treatment->description}}</td>
            <td>{{$treatment->date}}</td>
            <td>
              <a class="btn btn-success btn-sm" data-toggle="modal" data-target="#imageModal">
                <i class="fa fa-plus text-white"></i>
              </a>
            </td>
          </tr>
        @endif
      @endforeach
    </tbody>
  </table>
  @include('layout.modals.info_claim', $claim)
@endsection
