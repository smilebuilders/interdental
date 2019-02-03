<div class="card">
  <div class="card-header">
    <h3 class="d-inline">Ortho</h3>
    @if (Route::current()->getName() == 'policy')
      <a class="btn btn-primary float-right" href="/Ultramed/PolicyHolder/Edit?PolicyHolderId=6480">
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
        <td>Choupani , Elham  </td>
        <td>$0.00 </td>
      </tr>
    </tbody>
  </table>
</div>
