<template>
  <datepicker
    :bootstrap-styling="true"
    :format="format"
    :disabledDates="disabledDates"
    placeholder="Select Date"
    v-model="date"
    :value="date"
  ></datepicker>
</template>

<script>
import Datepicker from "vuejs-datepicker/dist/vuejs-datepicker.esm.js";
import * as lang from "vuejs-datepicker/src/locale";

export default {
  name: "app",
  components: {
    Datepicker
  },
  data() {
    return {
      date: '',
      format: "MM/dd/yyyy",
      disabledDates: {
        from: new Date()
      }
    }
  },
  methods: {
  }
};
</script>