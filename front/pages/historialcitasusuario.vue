<template>
   <v-data-table
      :headers="headers"
      :items="desserts"
      sort-by="fecha"
      class="elevation-1"
   
   >
   <template v-slot:item.status="{item}">

                           
<v-chip
  small
  class="ma-2"
  color="red"
  text-color="white"
  v-if="item.status===3"
 >
cancelado
</v-chip>
<v-chip
  small
  class="ma-2"
  color="green"
  text-color="white"
  v-if="item.status===1"
 >
Agendado
</v-chip>

</template>
    </v-data-table>
  </template>
  <script>
  export default {
    middleware: 'auth',
    data () {
      return {
        headers: [
      
        { text: 'USUARIO', value: 'name' },
        { text: 'HORARIO', value: 'descripcion' },
        { text: 'FECHA', value: 'fecha' ,sortable: false, },
        { text: 'ESTATUS', value: 'status' ,sortable: false,},
    
        
      ],
      desserts: [],
              datos:[],
              users_id:this.$auth.user.id,
      }
    },
    methods: {
        consultardata(){
            this.$axios.get('api/reservas',
       {
        params:{
            users_id:this.$auth.user.id
        }
       }).then((val)=>{
       this.desserts=val.data;
       console.log(val.data)
    }).catch(error=>{
      console.log(error)
    });




    },
    },
    created(){
  this.consultardata();

 },
  }
</script>