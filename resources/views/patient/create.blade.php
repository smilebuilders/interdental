@extends('layout.app')
@section('title', 'Agregar Paciente')

@section('content')
  <h1>Agregar Paciente</h1>
  <div class="create-patient-form">
    <form class="form" action="{{ route('patient_store') }}" method="post">
    @csrf
    <div class="row">
      <div class="col-md-6">

        <div class="form-group">
          <label>Nombre(s)</label>
          <input class="form-control" name="first_name" type="text" value="{{ old('first_name') }}" required>
          <span class="text-danger">{{ $errors->first('first_name') }}</span>
        </div>

        <div class="form-group">
          <label>Apellido(s)</label>
          <input class="form-control" name="last_name" type="text" value="{{ old('last_name') }}" required>
          <span class="text-danger">{{ $errors->first('last_name') }}</span>
        </div>

        <div class="form-group">
          <label>Fecha de Nacimiento (mm/dd/aaaa)</label>
          <input class="form-control" name="birth_date" type="datetime" value="{{ old('birthdate') }}">
          <span class="text-danger">{{ $errors->first('birth_date') }}</span>
        </div>

        <div class="form-group">
          <label>Género</label>
          <select class="form-control" name="gender"><option value="">- Seleccione -</option>
            <option value="1">Hombre</option>
            <option value="2">Mujer</option>
          </select>
          <span class="text-danger">{{ $errors->first('gender') }}</span>
        </div>

        <div class="form-group">
          <label>Aseguradora</label>
          <select class="form-control" name="insurance_id">
            <option value="">- Seleccione -</option>
            @foreach (App\Insurance::getInsurances() as $insurance)
              <option value="{{ $insurance->id }}">{{ $insurance->name }}</option>
            @endforeach
          </select>
          <span class="text-danger">{{ $errors->first('insurance_id') }}</span>
        </div>

        <div class="form-group">
          <label>Compañía</label>
          <input class="form-control" name="company" type="text" value="{{ old('company') }}">
          <span class="text-danger">{{ $errors->first('company') }}</span>
        </div>
      </div>

      <div class="col-md-6">

        <div class="form-group">
          <label>NSS</label>
          <input class="form-control" name="nss" type="text" value="{{ old('nss') }}">
          <span class="text-danger">{{ $errors->first('nss') }}</span>
        </div>

        <div class="form-group">
          <label>Id Póliza</label>
          <input class="form-control" name="policy_code" type="text" value="{{ old('policy_code') }}" required>
          <span class="text-danger">{{ $errors->first('policy_code') }}</span>
        </div>

        <div class="form-group">
          <label>Dirección</label>
          <input class="form-control" name="address" type="text" value="{{ old('address') }}">
          <span class="text-danger">{{ $errors->first('address') }}</span>
        </div>

        <div class="form-group">
          <label>Ciudad</label>
          <input class="form-control" name="city" type="text" value="{{ old('city') }}">
          <span class="text-danger">{{ $errors->first('city') }}</span>
        </div>

        <div class="form-group">
          <label>Estado</label>
          <input class="form-control" name="state" type="text" value="{{ old('state') }}">
          <span class="text-danger">{{ $errors->first('state') }}</span>
        </div>

        <div class="form-group">
          <label>Código Postal</label>
          <input class="form-control" name="zip_code" type="text" value="{{ old('zip_code') }}">
          <span class="text-danger">{{ $errors->first('zip_code') }}</span>
        </div>

        <div class="form-group">
          <label>Teléfono</label>
          <input class="form-control" name="phone" type="text" value="{{ old('phone') }}">
          <span class="text-danger">{{ $errors->first('phone') }}</span>
        </div>

      </div>

      <div class="col-sm-12 text-center btn-fix-bottom">
        <a class="btn btn-default" href="{{ route('index') }}">Cancelar</a>
        <input id="btnGuardar" type="submit" value="Guardar" class="btn btn-primary">
      </div>

    </div>
  </form>
  </div>
@endsection
