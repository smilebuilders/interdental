<div class="modal fade" id="infoClaim" tabindex="-1" role="dialog" aria-labelledby="infoClaim" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Informacion de Claim</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="infoClaimForm" action="{{ route('claim_update') }}" method="post">
          {{ csrf_field() }}
          <div class="form-group">
            <label for="type_of_transaction">Type Of Transaction</label>
            <br>
            <input class="" type="radio" name="type_of_transaction" value="1"
            @if ($claim->type_of_transaction == 1)
              checked
            @endif>
            Statement of Actual Services
            <br>
            <input class="" type="radio" name="type_of_transaction" value="2"
            @if ($claim->type_of_transaction == 2)
              checked
            @endif>
            Request for Predetermination/Preauthorization
          </div>

          <div class="form-group">
            <label>Remarks</label>
            <input class="form-control" name="remarks" type="text" value="{{ $claim->remarks }}">
          </div>

          <div class="form-group">
            <label>NEA#</label>
            <input class="form-control" name="nea" type="text" value="{{ $claim->nea }}">
          </div>

          <div class="form-group">
            <label>Number of Enclosures</label>
            <input class="form-control" name="number_enclosures" type="text" value="{{ $claim->number_enclosures }}">
          </div>

          <div class="form-group">
            <label>Is Orthodontics?</label> <br>
            <input id="is_ortho" type="checkbox"
            @if ($claim->is_ortho == 'true')
              checked
            @endif
            v-on:click="validateOrtho">

            <input type="hidden" name="is_ortho" v-model="isOrtho">
          </div>

          <div class="form-group" v-if="isOrtho">
            <label>Orthodontics date</label>
            <input class="form-control datefield" name="is_ortho_date" type="text" value="{{ $claim->is_ortho_date}}" required>
          </div>

          <div class="form-group" v-if="isOrtho">
            <label>Months of treatment remaining</label>
            <input class="form-control" name="remaining" type="text" value="{{ $claim->remaining }}" required>
          </div>


          <div class="form-group">
              <label>Replacement of Prosthesis?</label> <br>
              <input id="replacement_prosthesis" type="checkbox"
              @if ($claim->replacement_prosthesis == 'true')
                checked
              @endif
              v-on:click="validateProsthesis">

              <input type="hidden" name="replacement_prosthesis" v-model="isProsthesis">
          </div>

          <div class="form-group" v-if="isProsthesis">
              <label>Date Prior Placement</label>
              <input class="form-control datefield" name="placement_date" type="text" value="{{ $claim->placement_date }}" required>
          </div>
          <input type="hidden" name="id" value="{{ $claim->id }}">
        </form>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary" form="infoClaimForm">Guardar Cambios</button>
      </div>
    </div>
  </div>
</div>
