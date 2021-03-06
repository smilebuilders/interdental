<div class="card">
  <div class="card-header">
    <h3 class="d-inline">Dependientes</h3>
    @if (Route::current()->getName() == 'policy_verify')
      <a class="btn btn-primary float-right" href="{{ route('dependent_create', ['patient_id' => $policy->patient->id ]) }}">
        <span class="fa fa-plus"></span> Agregar Dependientes
      </a>
    @endif
  </div>

  <table class="table table-striped table-sm">
    <tbody>
      <tr class="text-sm line-top">
        <th>Nombre</th>
        <th>FDN</th>
        <th>Relación</th>
        <th>Género</th>
        <th>Editar</th>
        <th>Borrar</th>
      </tr>
      @foreach ($policy->patient->dependents($policy->patient->id) as $dependent)
        <tr>
          <td>{{ $dependent->first_name }} {{ $dependent->last_name }}</td>
          <td>{{ $dependent->birth_date }}</td>
          <td>{{ $dependent->relation }}</td>
          <td>{{ $dependent->gender }}</td>
          <td>
            <a class="btn btn-primary btn-sm" href="{{ route('dependent_edit', ['id' => $dependent->id]) }}"><span class="fa fa-edit"></span></a>
          </td>
          <td>
            <form action="{{ route('patient_delete',['id' => $dependent->id]) }}" method="POST">
              @csrf
              <button class="btn btn-danger btn-sm" type="submit"><span class="fa fa-trash"></span></button>
            </form>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>

</div>
