@extends('layout.app')
@section('title', 'Agregar Dependiente')

@section('content')
  <div class="row justify-content-md-center">
    <div class="col-sm-6">
      <form action="{{ route('dependent_update', ['id' => $dependent->id]) }}" method="post">
        {{ csrf_field() }}
        <div class="form-group">
          <label>Nombre(s)</label>
          <input class="form-control" name="first_name" type="text" value="{{ $dependent->first_name }}" required>
        </div>
        <div class="form-group">
          <label>Apellidos</label>
          <input class="form-control" type="text" name="last_name" value="{{ $dependent->last_name }}" required>
        </div>
        <div class="form-group">
          <label>Fecha de nacimiento</label>
          <input class="form-control" type="text" name="birth_date" value="{{ $dependent->birth_date }}" required>
        </div>
        <div class="form-group">
          <label>Género</label>
          <select class="form-control" name="gender" required>
            <option value="">-Seleccione-</option>
            <option value="Hombre">Hombre</option>
            <option value="Mujer">Mujer</option>
          </select>
        </div>
        <div class="form-group">
          <label>Relación</label>
          <select class="form-control" name="relation" required>
            <option value="">-Seleccione-</option>
            <option value="Esposo(a)">Esposo(a)</option>
            <option value="Hijo(a)">Hijo(a)</option>
            <option value="Otro">Otro</option>
          </select>
        </div>
        <div class="form-group">
          <label>Teléfono</label>
          <input class="form-control" type="text" name="phone" value="{{ $dependent->phone }}" required>
        </div>
        <div class="form-group">
          <label>Dirección</label>
          <textarea class="form-control" cols="20" name="address" rows="2" required>{{ $dependent->address }}</textarea>
        </div>
        <div class="form-group">
          <label>Ciudad</label>
          <input class="form-control" name="city" type="text" value="{{ $dependent->city }}" required>
        </div>
        <div class="form-group">
          <label>Estado</label>
          <input class="form-control" name="state" type="text" value="{{ $dependent->state }}" required>
        </div>
        <div class="form-group">
          <label>CP</label>
          <input class="form-control text-box single-line" name="zip_code" type="text" value="{{ $dependent->zip_code }}" required>
        </div>
        <div class="row">
          <div class="col-sm-12 text-center">
            <input type="submit" value="Guardar" class="btn btn-primary">
          </div>
        </div>
      </form>
    </div>
  </div>
@endsection