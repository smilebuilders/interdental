<div class="card">
  <div class="card-header">
    <h3 class="d-inline">Asegurado</h3>
    @if (Route::current()->getName() == 'policy_verify')
      <a class="btn btn-primary float-right" href="{{ route('patient_edit', [$policy->patient->id]) }}">
        <span class="fa fa-edit"></span> Asegurado
      </a>
    @endif
  </div>

  <table class="table table-striped table-sm">
    <tbody>
      <tr>
        <td>
        Nombre
        </td>
        <td>
          <span class="glyphicon glyphicon-star"></span>

            {!! $policy->patient->first_name . ', ' . $policy->patient->last_name !!}

        </td>
      </tr>
      <tr>
        <td>NSS</td>
        <td>{!! $policy->patient->nss !!}</td>
      </tr>
      <tr>
        <td>FDN</td>
        <td>{!! $policy->patient->birth_date !!}</td>
      </tr>
      <tr>
        <td>Género</td>
        <td>{!! $policy->patient->gender !!}</td>
      </tr>
      <tr>
        <td>Aseguradora</td>
        <td>{{ $policy->patient->insurance->name }}</td>
      </tr>
      <tr>
        <td>Telefono Aseguradora</td>
        <td>{{ $policy->patient->insurance->phone }}</td>
      </tr>
      <tr>
        <td>IdUltramed</td>
        <td></td>
      </tr>
      <tr>
        <td>Compañía</td>
        <td>{!! $policy->patient->company !!}</td>
      </tr>
      <tr>
        <td>Teléfono</td>
        <td> {!! $policy->patient->phone !!}</td>
      </tr>
      <tr>
        <td>Dentista</td>
        <td>Guevara, Ricardo  J.</td>
      </tr>
    </tbody>
  </table>
</div>
