@extends('layout.app')
@section('title', 'Editar Paciente')

@section('content')
  <form class="" action="{{ route('patient_update', [$patient->id]) }}" method="post">
  @csrf
  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <label>Nombre(s)</label>
        <input class="form-control" id="FirstName" name="first_name" type="text" value="{!! $patient->first_name !!}">
        <span class="text-danger">{{ $errors->first('first_name') }}</span>
      </div>
      <div class="form-group">
        <label>Apellido(s)</label>
        <input class="form-control" id="LastName" name="last_name" type="text" value="{!! $patient->last_name !!}">
        <span class="text-danger">{{ $errors->first('last_name') }}</span>
      </div>
      <div class="form-group">
        <label>Fecha de Nacimiento (mm/dd/aaaa)</label>
        <input class="form-control" id="Birthday" name="birth_date" type="datetime" value="{!! $patient->birth_date !!}">
        <span class="text-danger">{{ $errors->first('birth_date') }}</span>
      </div>
      <div class="form-group">
        <label>Género</label>
        <select class="form-control" id="Gender" name="gender">
          <option value="1">- Seleccione -</option>
          <option value="Hombre" {{ $patient->gender == 'Hombre' ? 'selected' : '' }}>Hombre</option>
          <option value="Mujer" {{ $patient->gender == 'Mujer' ? 'selected' : '' }}>Mujer</option>
        </select>
        <span class="text-danger">{{ $errors->first('gender') }}</span>
      </div>
      <div class="form-group">
        <label>Aseguradora</label>
        <select class="form-control" id="insurance_id" name="insurance_id">
          <option value="">- Seleccione -</option>
          @foreach (App\Insurance::getInsurances() as $insurance)
            <option value="{{ $insurance->id }}" {{ $patient->insurance_id == $insurance->id ? 'selected' : '' }}>{{ $insurance->name }}</option>
          @endforeach
        </select>
        <span class="text-danger">{{ $errors->first('insurance_id') }}</span>
      </div>
      <div class="form-group">
        <label>Compañía</label>
        <input class="form-control" id="Company" name="company" type="text" value="{!! $patient->company !!}">
        <span class="text-danger">{{ $errors->first('company') }}</span>
      </div>
    </div>

    <div class="col-md-6">
      <div class="form-group">
        <label>NSS</label>
        <input class="form-control" id="NSS" name="nss" type="text" value="{!! $patient->nss !!}">
        <span class="text-danger">{{ $errors->first('nss') }}</span>
      </div>
      <div class="form-group">
        <label>Id Póliza</label>
        <input class="form-control" id="Code" name="policy_code" type="text" value="{!! $patient->policy_code !!}">
        <span class="text-danger">{{ $errors->first('policy_code') }}</span>
      </div>
      <div class="form-group">
        <label>Dirección</label>
        <input class="form-control" id="Address" name="address" type="text" value="{!! $patient->address !!}">
        <span class="text-danger">{{ $errors->first('address') }}</span>
      </div>
      <div class="form-group">
        <label>Ciudad</label>
        <input class="form-control" id="City" name="city" type="text" value="{!! $patient->city !!}">
        <span class="text-danger">{{ $errors->first('city') }}</span>
      </div>
      <div class="form-group">
        <label>Estado</label>
        <input class="form-control" id="State" name="state" type="text" value="{!! $patient->state !!}">
        <span class="text-danger">{{ $errors->first('state') }}</span>
      </div>
      <div class="form-group">
        <label>Código Postal</label>
        <input class="form-control" id="ZipCode" name="zip_code" type="text" value="{!! $patient->zip_code !!}">
        <span class="text-danger">{{ $errors->first('zip_code') }}</span>
      </div>
      <div class="form-group">
        <label>Teléfono</label>
        <input class="form-control" id="Phone" name="phone" type="text" value="{!! $patient->phone !!}">
        <span class="text-danger">{{ $errors->first('phone') }}</span>
      </div>
    </div>
    <div class="col-sm-12 text-center btn-fix-bottom">
      <a class="btn btn-default" href="{{ route('policy_verify', [$patient->policy_code]) }}">Cancelar</a>
      <input id="btnGuardar" type="submit" value="Guardar" class="btn btn-primary">
    </div>
  </div>
  </form>
@endsection
