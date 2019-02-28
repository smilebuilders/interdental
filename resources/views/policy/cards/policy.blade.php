<div class="card">
  <div class="card-header">
    <h3 class="d-inline">Póliza</h3>
    @if (Route::current()->getName() == 'policy_verify')
      <a class="btn btn-primary float-right" href="{{ route('policy_edit', [$policy->id]) }}">
        <span class="fa fa-edit"></span> Póliza
      </a>
    @endif
  </div>

  <table class="table table-striped table-sm">
    <tbody>
      <tr>
        <td>No. Id</td>
        <td>{!! $policy->code !!}</td>
      </tr>
      <tr>
        <td>No. Grupo</td>
        <td>{!! $policy->group_code !!}</td>
      </tr>
      <tr>
        <td>Fecha Efectiva</td>
        <td>{!! $policy->aniversary_date !!}</td>
      </tr>
      <tr>
        <td>Máximo Anual</td>
        <td>{!! "$ ".number_format($policy->family_max, 2) !!}</td>
      </tr>
      <tr>
        <td>Deducible Familiar</td>
        <td>{!! "$ ".number_format($policy->family_deductible, 2) !!}</td>
      </tr>
      <tr>
        <td>Máximo Individual</td>
        <td>{!! "$ ".number_format($policy->individual_maximum, 2) !!}</td>
      </tr>
      <tr>
        <td>Deducible Individual</td>
        <td>{!! "$ ".number_format($policy->individual_deductible, 2) !!}</td>
      </tr>
      <tr>
        <td>Máximo Ortho Individual</td>
        <td>{!! "$ ".number_format($policy->individual_ortho_maximum, 2) !!}</td>
      </tr>
      {{-- <!--Nuevos datos-->
      <tr>
        <!--================== Annotations ================-->
        <!--Fin Check Box-->
        <!--Pago del seguro-->
        <td>
        </td>
        <!--Fin del pago del seguro-->
      </tr> --}}
    </tbody>
  </table>
</div>
