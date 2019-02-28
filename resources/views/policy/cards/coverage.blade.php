<div class="card">
  <div class="card-header">
    <h3 class="d-inline">Cobertura</h3>
    @if (Route::current()->getName() == 'policy_verify')
    <a class="btn btn-primary float-right" href="{{ route('policy_coverage_edit', [$policy->id]) }}">
      <span class="fa fa-edit"></span> Cobertura
    </a>
    @endif
  </div>

  <table class="table table-striped table-sm">
    <tbody>
      <tr>
        <th style="width: 80%">Categoría</th>
        <th style="width: 20%">Cobertura</th>
      </tr>
      <tr>
        <td>Preventivo </td>
        <td style="text-align: right"> {!! $policy->preventivo !!}% </td>
      </tr>
      <tr>
        <td>Básico </td>
        <td style="text-align: right"> {!! $policy->basico !!}% </td>
      </tr>
      <tr>
        <td>Mayor </td>
        <td style="text-align: right"> {!! $policy->mayor !!}% </td>
      </tr>
      <tr>
        <td>Resinas </td>
        <td style="text-align: right"> {!! $policy->resinas !!}% </td>
      </tr>
      <tr>
        <td>Endo </td>
        <td style="text-align: right"> {!! $policy->endo !!}% </td>
      </tr>
      <tr>
        <td>Perio </td>
        <td style="text-align: right"> {!! $policy->perio !!}% </td>
      </tr>
      <tr>
        <td>Prótesis </td>
        <td style="text-align: right"> {!! $policy->protesis !!}% </td>
      </tr>
      <tr>
        <td>Implantes </td>
        <td style="text-align: right"> {!! $policy->implantes !!}% </td>
      </tr>
      <tr>
        <td>Ortho </td>
        <td style="text-align: right"> {!! $policy->ortho !!}% </td>
      </tr>
    </tbody>
  </table>
</div>
