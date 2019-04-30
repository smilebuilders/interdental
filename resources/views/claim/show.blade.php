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
          <td>{{ $claim->patient->nss }}</td>
        </tr>
        <tr>
          <td>Aseguradora:</td>
          <td>{{ $claim->patient->insurance->name }}</td>
        </tr>

        <tr>
          <td>Compañia:</td>
          <td>{{$claim->patient->company}}</td>
        </tr>
      </tbody>
    </table>
  </div>

  <div class="row">
    <div class="col-sm-6">
      <h3 class="mb-3">Claim: <span class="text-success">{{$claim->code}}</span></h3>
      <button class="btn btn-primary" data-toggle="modal" data-target="#infoClaim">Info Claim</button>
      <button class="btn btn-primary" data-toggle="collapse" data-target="#claimConfig">Configurar Claim</button>
      @if ($claim->type_of_transaction != null)
        <a href="{{ url('/pdf', ['claim_id' => $claim->id]) }}" class="btn btn-success" target="new_blank">Claim</a>
      @endif
    </div>
    
    <div class="col-sm-6">
      <form action="{{ route('claim_change_status') }}" class="form-inline float-right" method="POST">
        @csrf
        <div class="form-group">
          <select name="status" class="form-control">
            <option value="generated">Generado</option>
            <option value="sent" {{ $claim->status == 'sent'? 'selected': '' }}>Enviado</option>
            <option value="paid" {{ $claim->status == 'paid'? 'selected': '' }}>Pagado</option>
            <option value="partial" {{ $claim->status == 'partial'? 'selected': '' }}>Partial</option>
            <option value="paid_client" {{ $claim->status == 'paid_client'? 'selected': '' }}>Pagado al Cliente</option>
            <option value="rejected" {{ $claim->status == 'rejected'? 'selected': '' }}>Rechazado</option>
          </select>
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn-primary">Guardar</button>
          <input type="hidden" name="claim" value="{{$claim->id}}">
        </div>
      </form>
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
        <th>Valor</th>
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
            <td class="text-right">
              <edit-price v-bind:treatment="{{ $treatment }}"></edit-price>
            </td>
          </tr>
        @endif
      @endforeach
    </tbody>
  </table>
  @include('layout.modals.info_claim', $claim)
@endsection
