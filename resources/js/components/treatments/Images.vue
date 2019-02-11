<template>
  <div
    class="modal fade"
    id="uploadImage"
    tabindex="-1"
    role="dialog"
    aria-labelledby="uploadImage"
    aria-hidden="true"
  >
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Agregar imagen a tratamiento</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form enctype="multipart/form-data" id="uploadImageForm" action="/treatment/upload-image" method="post">
          <input type="hidden" name="_token" :value="csrf">
            <div class="input-group mb-3">
              <div class="custom-file">
                <input type="file" name="image[]"  multiple>
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
              <tr v-for="(image, index) in images" v-bind:key="image.id">
                <td>
                  <img v-bind:src="'https://interdental-solutions.sfo2.digitaloceanspaces.com' + '/uploads/' + image.filename" alt width="50px">
                </td>
                <td>
                  <button class="btn btn-sm btn-danger" v-on:click="deleteImage(index)"><span class="fa fa-trash"></span></button>
                </td>
              </tr>
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
</template>

<script>

export default {
  props: ['images', 'treatment_id'],
  data() {
    return {
      csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    }
  },
  methods: {
    uploadImage: function() {
      let formData = new FormData();
      formData.append('image', this.imgs);
      
      axios.post('/treatment/upload-image', 
        formData, 
        {
        headers: {
          'Content-Type': 'multipart/form-data'
        }
      }).then(function(response) {
        console.log(response);
        
      })
      
    },
    deleteImage: function(index) {
      
      axios.post('/treatment/delete-image', {
        'image_id': this.images[index].id
      })
      .then(response => {
        console.log(response);
        this.images.splice(index, 1);
      });
    },
  }
}
</script>

