<template>
<div>
<table class="table table-striped" id="table_0">
    <thead class="th-listado">
      <tr>
        <th>
          <input type="checkbox" class="selectAllTreatments">
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
          <input type="checkbox" v-bind:value="treatment.id" v-model="checkedTreatments">
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
          <a class="btn btn-success btn-sm" data-toggle="modal" data-target="#uploadImage">
              <i class="fa fa-plus text-white"></i>
          </a>
        </td>
      </tr>
    </tbody>
  </table>

    <div class="col-sm-12 text-center" v-if="checkedTreatments.length > 0">
        <button class="btn btn-success btn-lg mt-3" v-on:click="sendTreatments">Enviar tratamiento</button>
    </div>
</div>
</template>

<script>
import Delete from "./Delete.vue";

export default {
  components: {
    "delete-treatment": Delete
  },
  props: ["patient"],
  data() {
    return {
      treatments: [],
      checkedTreatments: [],
    };
  },
  beforeMount() {
    this.getTreatments();
  },
  methods: {
    getTreatments() {
      axios
        .get('/patient/treatments/get/' + this.patient)
        .then(response => (this.treatments = response.data));
    },

    sendTreatments() {
        axios.post('/treatments/send', {
            treatments: this.checkedTreatments,
            patient: this.patient
        })
        .then(function(response) {
            // console.log(response);
            location.reload();
        })
        .catch(function(error) {
            console.log(error);
        });
    }
  }
}
</script>
