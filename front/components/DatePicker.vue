<template>
    <v-menu v-model="menu" offset-y :close-on-content-click="false">
      <template v-slot:activator="{ on }">
        <v-icon v-on="on" color="primary">mdi-calendar</v-icon>
      </template>
      <v-date-picker v-model="picker" 
      @click="menu = false"
      :allowed-dates="allowedDates"
      :min="hoy"
      />
    </v-menu>
  </template>
  <script lang="ts">
  export default {
   
    props: {
      value: {
        type: String,
        default: new Date().toISOString().substr(0, 10),
      },
    },
    data() {
      return {
        hoy:'',
        allowedDates: val => ![5, 6].includes(new Date(val).getDay()),
        menu: false,
      };
    },
    computed: {
      picker: {
        get() {
          return this.value;
        },
        set(val) {
          this.menu = false;
          this.$emit("input", val);
        },

        printDate() {

         let dat, day,month, year, month1
         dat = new Date()
        day=dat.getDate().toString().padStart(2,'0');
         month=dat.getMonth()+ 1;
          month1=  month.toString().padStart(2,'0');
        year=dat.getFullYear();
       this.hoy=year+'-'+month1+'-'+day;
       console.log(this.hoy)
       return  this.hoy
        },
   
      },
   

     
 
},
}
   
 
  </script>