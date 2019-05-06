<template>
    <div style="width:100%;">
        <table class="table table-striped">
        <thead>
            <tr>
                <th><input type="checkbox" class="selectAllTreatments" v-model="selectAll"></th>
                <th>No.</th>
                <th>S / C</th>
                <th>D.F.</th>
                <th># Código</th>
                <th>Descripción del Tratamiento</th>
                <th>Transacción</th>
                <th>Fecha</th>
                <th>Imagen</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="treatment in treatments" v-bind:key="treatment.id">
                <td><input type="checkbox" v-model="selected" :value="treatment.id" number></td>
                <td>{{treatment.number}}</td>
                <td>{{treatment.sc}}</td>
                <td>{{treatment.df}}</td>
                <td>
                    <a class="btn btn-success btn-sm" data-toggle="modal" href="#" data-target="#myModal">
                        <span class="fa fa-edit"></span>
                        {{treatment.code}}
                    </a>
                </td>
                <td>{{treatment.description}}</td>
                <td>Actual Services</td>
                <td>{{treatment.date}}</td>
                <td>
                  <a class="btn btn-success btn-sm" data-toggle="modal" data-target="#uploadImage" v-on:click="setImageId(treatment.id)">
                      <i class="fa fa-plus text-white"></i>
                  </a>
                </td>
                <td>
                    <delete-treatment v-bind:treatment="treatment.id"></delete-treatment>
                </td>
            </tr>
        </tbody>
    </table>
        <div class="col-sm-12 text-center" v-if="selected.length > 0">
            <button class="btn btn-success btn-lg mt-3" v-on:click="generateClaim">Generar Claim</button>
        </div>

        <treatment-images v-bind:images="images"></treatment-images>
</div>
</template>

<script>
import Delete from '../treatments/Delete.vue';
import Images from "../treatments/Images.vue";
export default {
    components: {
        'delete-treatment': Delete,
        "treatment-images": Images
    },
    props: ['claim', 'status'],
    data() {
        return {
            treatments: [],
            selected: [],
            images: null
        }
    },
    beforeMount() {
        this.getTreatments()
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
            axios.get('/claim/treatments/get/' + this.claim, {
            })
            .then(response => (this.treatments = response.data))
        },
        generateClaim() {
            axios.post('/claim/generate', {
                treatments: this.selected,
                claim: this.claim
            })
            .then(function(response){
                location.reload();
                console.log(response);
            })
            .catch(function(error) {
                console.log(error);
            })
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
