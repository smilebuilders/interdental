<template>
    <select id="estatus" class="form-control text-small" v-on:change="changeStatus" v-model="selected">
        <option value="1">En Proceso de Verificación</option>
        <option value="2">Con Cobertura</option>
        <option value="3">Sin Cobertura</option>
    </select>
</template>

<script>
export default {
    props: ['policy', 'status'],
    data() {
        return {
            selected: ''
        }
    },
    created() {
        this.selected = this.status;
    },
    methods: {
        changeStatus: function() {
            axios.post('/policy/change-status', {
                policy: this.policy,
                status: this.selected
            })
            .then(function(response) {
                // console.log(response);
                location.reload();
            })
            .catch(function(error) {
                console.log(error);
            })
        }
    }
}
</script>
