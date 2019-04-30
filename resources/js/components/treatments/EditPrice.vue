<template>
  <div>
    <span v-show="this.disabled == true" @dblclick="this.edit">{{ price }}.00</span>
    <input v-show="this.disabled == false" @keyup.enter="edit" v-on:blur="this.edit" type="text" v-model="price">
  </div>
</template>

<script>
export default {
  props: ['treatment'],
  data() {
    return {
      price: this.treatment.price,
      disabled: true,
    }
  },
  methods: {
    edit: function(event) {
      this.disabled = !this.disabled;
      this.update();
    },
    update: function() {
      axios.post('/ajax/update-price', {
        id: this.treatment.id,
        price: this.price,
      })
      .then(response => {
        console.log(response);
      })
      .catch(function(error) {
        console.log(error);
      });
    }
  } 
}
</script>

