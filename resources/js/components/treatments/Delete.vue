<template>
    <button class="btn btn-danger btn-sm" v-on:click="deleteTreatment">
        <i class="fa fa-trash"></i>
        <span class="sr-only"></span>
    </button>
</template>
<script>
export default {
    // treatment id 
    props: ['treatment'],
    methods: {
        deleteTreatment() {
            var r = confirm('Estas seguro que quieres eliminar' + this.treatment);
            if(r) {
                axios.post('/treatments/delete/' + this.treatment)
            .then(function (response) {
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
