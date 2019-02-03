<div class="card">
  <div class="card-header">
    <h3 class="d-inline">Comentarios</h3>
    @if (Route::current()->getName() == 'policy')
    <button class="btn btn-primary float-right" form="comments">
      Guardar
    </button>
    @endif
  </div>
  
  <form id="comments" class="" action="{{ route('policy_update', ['id'=> $patient->id]) }}" method="post">
    {{ csrf_field() }}
    <textarea name="comments" class="form-control"
      @if (Route::current()->getName() != 'policy')
        disabled
      @endif
    rows="10" cols="80" maxlength="500" placeholder="Escribe un comentario" style="resize: none">{{ $patient->policy->comments }}</textarea>
  </form>
</div>
