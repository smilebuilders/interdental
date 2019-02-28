<div class="card">
  <div class="card-header">
    <h3 class="d-inline">Extra Cobertura</h3>
    @if (Route::current()->getName() == 'policy_verify')
    <a class="btn btn-primary float-right" href="{{ route('policy_extra_coverage_edit', [$policy->id]) }}">
      <span class="fa fa-edit"></span> Extra Cobertura
    </a>
    @endif
  </div>

  <table class="table table-striped table-sm">
    <tbody>
      <tr class="text-sm line-top">
      <th style="width: 60%">Nombre</th>
      <th style="width: 40%">Descripción</th>
    </tr>
    <tr>
      <td>Rayos X / Panorámica  </td>
      <td>{!! $policy->rayosx !!}</td>
    </tr>
    <tr>
      <td>Limpieza / Prophy </td>
      <td>{!! $policy->limpieza !!}</td>
    </tr>
    <tr>
      <td>Aplicación de Flour </td>
      <td>{!! $policy->flour !!}</td>
    </tr>
    <tr>
      <td>Reemplazo de Coronas </td>
      <td>{!! $policy->coronas !!}</td>
    </tr>
    <tr>
      <td>Selladores </td>
      <td>{!! $policy->selladores !!}</td>
    </tr>
    <tr>
      <td>Extracciones Previas</td>
      <td>{!! $policy->extracciones_previas !!}</td>
    </tr>
  </tbody>
</table>
</div>
