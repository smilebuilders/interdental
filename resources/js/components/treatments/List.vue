<template>
<div>
<table class="table table-striped" id="table_0">
    <thead class="th-listado">
      <tr>
        <th>
          <input type="checkbox" class="selectAll" v-model="selectAll">
        </th>
        <th>No.</th>
        <th>S / C</th>
        <th>D.F.</th>
        <th># Código</th>
        <th>Descripción del Tratamiento</th>
        <th>Fecha</th>
        <th>Estatus</th>
        <th>Imagen</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="treatment in treatments" v-bind:key="treatment.id">
        <td>
          <input type="checkbox" v-model="selected" :value="treatment.id" number>
        </td>
        <td>{{treatment.number}}</td>
        <td>{{treatment.sc}}</td>
        <td>{{treatment.df}}</td>
        <td>{{treatment.code}}</td>
        <td>{{treatment.description}}</td>
        <td>{{treatment.date}}</td>
        <td>
          <delete-treatment v-if="treatment.status == ''" v-bind:treatment="treatment.id"></delete-treatment>
          <div v-else class="status-send circle" style="margin:0">{{treatment.status}}</div>
        </td>
        <td>
          <a class="btn btn-success btn-sm" data-toggle="modal" data-target="#uploadImage" v-on:click="setImageId(treatment.id)">
              <i class="fa fa-plus text-white"></i>
          </a>
        </td>
      </tr>
    </tbody>
  </table>

    <div class="col-sm-12 text-center" v-if="selected.length > 0">
        <button class="btn btn-success btn-lg mt-3" v-on:click="sendTreatments">Enviar tratamiento</button>
    </div>

    <treatment-images v-bind:images="images"></treatment-images>

</div>
</template>

<script>
import Delete from "./Delete.vue";
import Images from "../treatments/Images.vue";

export default {
  components: {
    "delete-treatment": Delete,
    "treatment-images": Images
  },
  props: ["patient"],
  data() {
    return {
      treatments: [],
      selected: [],
      images: null,
    };
  },
  beforeMount() {
    this.getTreatments();
  },
  computed: {
    selectAll: {
      get: function() {
        return this.treatments ? this.selected.length == this.treatments.length : false;
      }, 
      set: function(value) {
        var selected = [];

        if(value) {
          this.treatments.forEach(function (treatment) {
            selected.push(treatment.id);
          });
        }
        this.selected = selected;
      }
    }
  },
  methods: {
    getTreatments() {
      axios
        .get('/treatment/generated/' + this.patient)
        .then(response => (this.treatments = response.data));
    },
    sendTreatments() {
        axios.post('/treatment/send', {
            treatments: this.selected,
            patient_id: this.patient
        })
        .then(function(response) {
            location.reload();
            console.log(response);
        })
        .catch(function(error) {
            console.log(error);
        });
    },

    setImageId(id) {
      $('input[name="treatment_id"]').val(id);
      axios
      .get('/treatment/' + id)
      .then(response => (this.images = response.data));
    }

  }
}
</script>
