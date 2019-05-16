<table class="table table-striped table-condensed">
  
    <thead>
      <tr class="text-center">
        <th style="width: 20%">Nombre</th>
        <th>NSS</th>
        <th>FDN</th>
        <th>Aseguradora</th>
        <th>Asegurado</th>
        <th>Verificado</th>
        <th>Claim</th>
        <th>Tratamientos</th>
        <th>Beneficios</th>
      </tr>
    </thead>

    <tbody>
      @if (isset($patients) && count($patients) > 0)
        @foreach ($patients as $patient)
          <tr>
            <td><a href="{{ route('policy_verify', ['id' => $patient->id]) }}">{!! $patient->first_name . ' ' . $patient->last_name !!}</a></td>
            <td>{!! $patient->nss !!}</td>
            <td>{!! $patient->birth_date !!}</td>
            <td>{!! $patient->ensurance !!}</td>
            <td>
              @if (isset($patient->policy))
                @if ($patient->policy->status == 1)
                  <div class="status-send circle">R</div>
                @elseif($patient->policy->status == 2)
                  <div class="status-ok circle">✓</div>
                @elseif($patient->policy->status == 3)
                  <div class="status-no circle">✘</div>
                @endif
              @endif
            </td>
            <td>
              @if (isset($patient->policy))
                @if ($patient->policy->verified == 1)
                  <div class="status-send circle">R</div>
                @elseif($patient->policy->verified == 2 || $patient->policy->verified == 3)
                  <div class="status-ok circle">✓</div>
                @endif
              @endif
            </td>
            <td>
              <a class="text-white" href="{{route('patient_claims',[$patient->id])}}">
                <div class="status-claims circle">
                  {{count($patient->claimsCreated())}}
                </div>
              </a>
            </td>
            <td class="text-center"> 
              <a class="btn btn-success btn-sm" href="{{ route('patient_treatments', [$patient->id]) }}"><span class="fa fa-search"></span></a> 
            </td>
            <td>
                <a class="btn btn-success btn-sm" href="{{ route('patient_benefits', $patient->id) }}"><span class="fa fa-search"></span></a>
            </td>
          </tr>
        @endforeach
      @else
        <tr>
          <td colspan="9" class="text-center">
            <label class="alert alert-danger">No se encontraron resultados</label>
          </td>
        </tr>
      @endif
    </tbody>
  </table>