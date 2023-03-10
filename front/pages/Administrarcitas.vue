<template>
  <v-data-table
    :headers="headers"
    :items="desserts"
    sort-by="fecha"
    class="elevation-1"
  
    >
   
      <template v-slot:top>
      <v-toolbar
          flat
        >
        <v-toolbar-title>Historial de citas</v-toolbar-title>
        <v-divider
          class="mx-4"
          inset
          vertical
        ></v-divider>
        <v-spacer></v-spacer>
        
       
          <template >
            <v-text-field 
                 v-model="fecha"
                 type="date"
                 label="Fecha "
                 min="date"
                @input="gethorarioselect"
                 >
               </v-text-field>
          </template>
    








        <v-dialog v-model="dialogCancel" max-width="500px"
     
        >
        <template v-slot:activator="{ on, attrs }">
              
            </template>
            <v-card>
              <v-card-title class="text-h5">¿Estas seguro de cancelar esta cita?</v-card-title>
              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="blue darken-1" text @click="dialogCancel=false">Cancelar</v-btn>
                <v-btn color="blue darken-1" text @click=" update" >OK</v-btn>
                <v-spacer></v-spacer>
              </v-card-actions>
            </v-card>
          </v-dialog>
          </v-toolbar>
      </template>
      <template v-slot:item.actions="{ item }">
        <v-icon
        color="red"
          class="mr-2"
          
          @click="editItem(item)"
        >
          mdi-cancel
         
        </v-icon>
       
     
      </template>

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
    middleware: 'isadmin',
    data () {
      return {
        headers: [
      { text: 'ID', value: 'id' },
      { text: 'USUARIO', value: 'name' },
      { text: 'HORARIO', value: 'descripcion' },
      { text: 'FECHA', value: 'fecha' ,sortable: false },
     
        { text: 'ESTATUS', value: 'status',sortable: false},
      
 
      { text: 'Actions', value: 'actions', sortable: false },
  
      
    ],
    date:'',
    fecha:'',
    desserts: [],
     estatus: [],
      dialogCancel:false,
      editedIndex: -1,    
      users_id:this.$auth.user.id,
    editedItem: {
         id: '',
         descripcion:'',
        fecha: '',
        status: '',
       
      },
      }
    },
    watch: {
      
      dialogCancel(val) {
        val || this.closeCancel()
      },
     
    },
    methods: {
   
    closeCancel() {
        this.dialogcancel= false;
       
      },
      editItem (item) {
        this.editedIndex = this.desserts.indexOf(item)
        this.editedItem = Object.assign({}, item)
        this.dialogCancel = true
      },
      
//metodo update-- desde la api.
async     update () {
 
 Object.assign(this.desserts[this.editedIndex], this.editedItem)
 try {
            let errors = []
          await this.$axios.$get('sanctum/csrf-cookie')
            await this.$axios.put('api/reservas/{update}', {
            'id':this.editedItem.id,
            
           


            } )
                .then((resp) => {
                   this.consultardata();
                })
               
                .catch((err) => {
                    if (err.response.status = 422) {
                        errors = err.response.data.errors
                        console.log(errors);
                    }
                }).finally(()=>{
                // loader stop
                this.dialogCancel=false;
                this.$swal("Has cancelado la cita")
                  });
                this.errors = errors
          
        } catch (error) {
            
        }
 











},
printDate() {

let dat, day,month, year
dat = new Date()
day=dat.getDate().toString().padStart(2,'0')
month=dat.getMonth().toString().padStart(2,'0')
year=dat.getFullYear();
return year+'/'+month+'/'+day
        },

 gethorarioselect(){

     this.$axios.get('api/reservas/{fecha}',{params:{fecha:this.fecha}}).then((val)=>{
     this.desserts =val.data;
     this.$swal(val.data.message); 
     }).catch(error=>{
     console.log(error)
     });

/* else {
this.$swal('No estas en horario laboral '+'<br>'+'recuerda es de 8 am a 8 pm');
}*/

},

    },
 created(){

  this.date = this.printDate();
 },
  }
</script>