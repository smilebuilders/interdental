<template>
  <div class="modal fade" id="addTreatment">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="addTreatmentLabel">Agregar Tratamiento</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body" v-if="state == 1">
          <div class="form-group">
            <label for="tCategory">Categoria:</label>
            <select class="form-control" id="tCategory" name="tCategory" v-model="selected" v-on:change="getTreatments">
              <option value="1">Diagnóstico</option>
              <option value="2">Preventiva</option>
              <option value="3">Restaurativo</option>
              <option value="4">Endodoncia</option>
              <option value="5">Periodoncia</option>
              <option value="6">Protesis Removible</option>
              <option value="7">Implantes</option>
              <option value="8">Protesis Fija</option>
              <option value="9">Oral Cirugias Maxilofaciales</option>
              <option value="10">Ortodoncia</option>
              <option value="11">Servicios Generales</option>
              <option value="12">Mayor</option>
            </select>
          </div>
          <div class="form-group">
            <label for="tDate">Fercha:</label>
            <datepicker></datepicker>
          </div>
          <div id="tableScroll">
            <table id="tProcedures" class="table table-striped table-sm">
              <thead>
                <tr class="th-listado">
                  <th>
                    <label>Código</label>
                  </th>
                  <th>
                    <label>Descripción</label>
                  </th>
                  <th></th>
                </tr>
              </thead>
              <tbody id="procedures">
                <tr v-for="(treatment, index) in treatments" v-bind:key="treatment.id">
                  <td>{{treatment.code}}</td>
                  <td>{{treatment.name}}</td>
                  <td>
                    <a href="#" v-on:click="nextState(index)">
                      <label class="btn btn-success btn-sm">+</label>
                    </a>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        
        <div class="modal-body" v-if="state == 2">
          <h5>{{ currentTreatment.name }}</h5>
          <hr>

          <teeth-table v-if="teethTable" v-bind:options="options"></teeth-table>
          <no-teeth-table v-if="noTeethTable" v-bind:options="options"></no-teeth-table>
          <surfaces v-if="surface"></surfaces>
          <quadrant v-if="quadrant"></quadrant>

          <div class="input-group">
            <div class="input-group-prepend">
              <div class="input-group-text">$</div>
            </div>
            <input type="text" class="form-control" id="price" placeholder readonly v-bind:value="currentTreatment.price">
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-warning" v-on:click.prevent="state = 1" v-if="state == 2">Regresar</button>
          <button type="button" class="btn btn-primary" v-if="state == 2" v-on:click="addTreatment">Agregar</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import DatePicker from './options/DatePicker.vue'
import TeethTable from './options/TeethTable.vue'
import NoTeethTable from './options/NoTeethTable.vue'
import Surfaces from './options/Surfaces.vue'
import Quadrant from './options/Quadrant.vue'

export default {
    props: ['patient'],
    components: {
        'datepicker': DatePicker,
        'teeth-table': TeethTable,
        'no-teeth-table': NoTeethTable,
        'surfaces': Surfaces,
        'quadrant': Quadrant
    },
    data() {
        return {
        state: 1,
        selected: "1",
        treatments: [],
        currentTreatment: "",
        options: [],
        validate: [],
        date: '',
        sc: '',
        df: '',
        //dislpay options
        teethTable: false,
        noTeethTable: false,
        surface: false,
        quadrant: false,
        };
    },
    mounted() {
        this.getTreatments();
        
    },
    methods: {
        // get all treatments with the selected category
        getTreatments() {
            axios
            .get("http://165.227.58.35/treatment/get/" + this.selected)
            .then(response => (this.treatments = response.data))
            .catch(function(error) {
              console.log(error);
            });
            
        },
        // select current treatment for display info on state 2 
        nextState(index) {
            if($('.vdp-datepicker').attr("value") != "") {
                this.currentTreatment = this.treatments[index];
                var options = this.currentTreatment.options.split(",");
                this.options = this.currentTreatment.options.split(",");
                this.date = $('.vdp-datepicker input').val();
                this.state = 2;
                this.displayOptions(options);
                // console.log(this.options);
                
            }  else {
                $('.vdp-datepicker input').trigger( "click" );
            }
        },
        // option to display elements on state 2
        displayOptions(options) { 
            console.log(this.currentTreatment.options);
            // display teeth table
            if (options.includes("teeth")) {
                this.teethTable = true;
                this.validate.push("teeth");
            } else {
                this.teethTable =false;
            }  
            // display teeth table
            if (options.includes("noteeth")) {
                this.noTeethTable = true;
            } else {
                this.noTeethTable =false;
            }    
            //surface
            if (/^(\w*,?surface+)-?(\d?)/.test(this.currentTreatment.options)) {
                this.surface = true
                this.validate.push("surface");
            }   else {
                this.surface = false;
            }  
            //quadrant
            if(options.includes("quadrant")) {
                this.quadrant = true
            } else {
                this.quadrant = false
            }
            
        },
        // add treatment to patient treatment list
        addTreatment() {
            var verified = true;

            var teeth;
            var noTeeth;
            var noTeethValue = [];
            var surfaces = [];
            var quadrant;

            if (this.teethTable) {
                teeth = $('#teeth .selected').text();
                if (teeth == "") {
                    alert('Seleccione diente');
                    verified = false;
                } 
            }

            if (this.noTeethTable) {
                noTeeth = $('#noteeth .selected').get();
                noTeeth.forEach(element => {
                    noTeethValue.push(element.innerHTML)
                });
                
                this.df = noTeethValue.toString();
                // console.log(this.df);
                console.log(this.df);
                
            }

            if (this.surface) {
                var number = this.currentTreatment.options.match(/^(\w*,?surface+)-?(\d?)/)[2];

                $(".checkbox input:checked").each(function() {
                    surfaces.push($(this).val());
                });

                if(number == 4 && surfaces.length < 4) {
                    alert("Seleccione al menos " + number + " superficies");
                    verified = false;
                } else if(surfaces.length < number || surfaces.length > number) {
                    alert("Seleccione " + number + " superficies");
                    verified = false;
                }
                this.sc = surfaces.toString();
            } 

            if (this.quadrant) {
                quadrant = $('#quadrants').val();
                
                if (quadrant == 0) {
                    alert('Seleccione Cuadrante');
                    verified = false;
                }
                this.sc = quadrant; 
            }
            
            if(verified) {
                axios.post('/treatment/store', {
                    number: teeth,
                    sc: this.sc,
                    df: this.df,
                    code: this.currentTreatment.code,
                    description: this.currentTreatment.name,
                    patient_id: this.patient,
                    date: this.date
                })
                .then(function (response) {
                    // console.log(response);
                    location.reload();
                })
                .catch(function (error) {
                    console.log(error);
                });
            }

        }
    }
}
</script>
