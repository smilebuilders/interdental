<template>
    <div style="width:100%;">
        <table class="table table-striped">
        <thead>
            <tr>
                <th><input type="checkbox" class="selectAllTreatments"></th>
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
                <td><input type="checkbox" v-bind:value="treatment.id" v-model="checkedTreatments"></td>
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
                <td><a class="btn btn-success btn-sm" data-toggle="modal" href="#" data-target="#imageModal">+</a></td>
                <td>
                    <delete-treatment v-bind:treatment="treatment.id"></delete-treatment>
                </td>
            </tr>
        </tbody>
    </table>
        <div class="col-sm-12 text-center" v-if="checkedTreatments.length > 0">
            <button class="btn btn-success btn-lg mt-3" v-on:click="generateClaim">Generar Claim</button>
        </div>
</div>
</template>

<script>
import Delete from '../treatments/Delete.vue';
export default {
    components: {
        'delete-treatment': Delete
    },
    props: ['claim', 'status'],
    data() {
        return {
            treatments: [],
            checkedTreatments: []
        }
    },
    beforeMount() {
        this.getTreatments()
    },
    methods: {
        getTreatments() {
            axios.get('/claim/treatments/get/' + this.claim, {
            })
            .then(response => (this.treatments = response.data))
        },
        generateClaim() {
            axios.post('/claim/generate', {
                treatments: this.checkedTreatments,
                claim: this.claim
            })
            .then(function(response){
                location.reload();
                console.log(response);
            })
            .catch(function(error) {
                console.log(error);
            })
        }
    }
}
</script>
