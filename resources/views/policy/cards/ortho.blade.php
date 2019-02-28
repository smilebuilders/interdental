<div class="card">
  <div class="card-header">
    <h3 class="d-inline">Ortho</h3>
    @if (Route::current()->getName() == 'policy_verify')
      <a class="btn btn-primary float-right" href="{{route('remaining_ortho_edit', ['id'=>$policy->id])}}">
        <span class="fa fa-edit"></span> Ortho
      </a>
    @endif 
  </div>

  <table class="table table-striped table-sm">
    <tbody>
      <tr class="text-sm line-top">
        <th style="width: 70%">Nombre</th>
        <th style="width: 15%">Restante</th>
      </tr>
      <tr>
            
        <td>{{$policy->patient->first_name}}, {{$policy->patient->last_name}}</td>
        <td>{!! "$ ".number_format($policy->patient->remaining_ortho, 2) !!}</td>
      </tr>
      @foreach ($policy->patient->dependents($policy->patient->id) as $dependent)
        <tr>
          <td>{{$dependent->first_name}}, {{$dependent->last_name}}</td>
          <td>{!! "$ ".number_format($dependent->remaining_ortho, 2) !!}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>
