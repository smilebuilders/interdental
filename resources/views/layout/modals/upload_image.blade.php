<div class="modal fade" id="uploadImage" tabindex="-1" role="dialog" aria-labelledby="uploadImage" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Agregar imagen a tratamiento</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form enctype="multipart/form-data" id="uploadImageForm" action="{{ route('treatment_add_image') }}" method="post">
          {{ csrf_field() }}
          <div class="input-group mb-3">
            <div class="custom-file">
              <input type="file" name="image[]" value="" multiple>
            </div>
            <input type="hidden" name="treatment_id" value="">
          </div>
        </form>
        <table class="table">
          <thead>
            <th>Imagen</th>
            <th></th>
          </thead>
          <tbody>
            {{-- @foreach ($patient->treatments as $treatment)
                {{dd($treatment->images())}}
            @endforeach --}}
            {{-- @foreach ($patient->images as $image) --}}
                {{-- <tr>
                  <td>
                  <img src="{{asset('uploads/' . $image->filename)}}" alt="" width="50px">
                  </td>
                  <td>
                    <form action="{{route('treatment_delete_image')}}" method="POST">
                      @csrf
                      <input type="hidden" name="image_id" value="{{$image->id}}">
                      <button class="btn btn-danger btn-sm"><span class="fa fa-trash"></span></button>
                    </form>
                  </td>
                </tr> --}}
            {{-- @endforeach --}}
            <treatments-images>
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary" form="uploadImageForm">Guardar Cambios</button>
      </div>
    </div>
  </div>
</div>
