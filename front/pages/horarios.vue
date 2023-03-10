<template>
    
  <v-data-table
    :headers="headers"
    :items="desserts"
    sort-by="Descripcion"
    class="elevation-1"
  >
    <template v-slot:top>
      <v-toolbar
        flat
      >
        <v-toolbar-title>Mis Horarios</v-toolbar-title>
        <v-divider
          class="mx-4"
          inset
          vertical
        ></v-divider>
        <v-spacer></v-spacer>
        <v-dialog
          v-model="dialog"
          max-width="500px"
        >
          <template v-slot:activator="{ on, attrs }">
            <v-btn
              color="primary"
              dark
              class="mb-2"
              v-bind="attrs"
              v-on="on"
            >
             Agregar horario
            </v-btn>
          </template>
          <v-card>
            <v-card-title>
              <span class="text-h5">{{ formTitle }}</span>
            </v-card-title>

            <v-card-text>
              <v-container>
                <v-row>
                  <v-col
                    cols="12"
                    sm="6"
                    md="4"
                  >
                 
                  
                <v-text-field
                      v-model="editedItem.descripcion"
                      label="Descripcion"
                    ></v-text-field>
                  </v-col>
                  <v-col
                    cols="12"
                    sm="6"
                    md="4"
                  >
                    <v-menu
      ref="menu"
      v-model="menu2"
      :close-on-content-click="false"
      :nudge-right="40"
      :return-value.sync="time"
      transition="scale-transition"
      offset-y
      max-width="290px"
      min-width="290px"
    >
      <template v-slot:activator="{ on, attrs }">
        <v-text-field
          v-model="editedItem.start"
          label="Comienza"
          
          readonly
          v-bind="attrs"
          v-on="on"
        ></v-text-field>
      </template>
      <v-time-picker
        v-if="menu2"
        v-model="editedItem.start"
        full-width
        @click:minute="$refs.menu.save(editedItem.start)"
      ></v-time-picker>
                   </v-menu>
                  </v-col>
                  <v-col
                    cols="12"
                    sm="6"
                    md="4"
                  >
                  <v-menu
      ref="menu2"
      v-model="menu22"
      :close-on-content-click="false"
      :nudge-right="40"
      :return-value.sync="time"
      transition="scale-transition"
      offset-y
      max-width="290px"
      min-width="290px"
    >
      <template v-slot:activator="{ on, attrs }">
        <v-text-field
          v-model="editedItem.end"
          label="Termina"
          
          readonly
          v-bind="attrs"
          v-on="on"
        ></v-text-field>
      </template>
      <v-time-picker
        v-if="menu22"
        v-model="editedItem.end"
        full-width
        @click:minute="$refs.menu2.save(editedItem.end)"
      ></v-time-picker>
                  </v-menu>
                  </v-col>
                  
                </v-row>
              </v-container>
            </v-card-text>

            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn
                color="blue darken-1"
                text
                @click="close"
              >
                Cancelar
              </v-btn>
              <v-btn
                color="blue darken-1"
                text
                v-on:click="register"
              >
               Guardar
              </v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>

        <v-dialog
          v-model="dialogupdate"
          max-width="500px"
        >
        <v-card>
          <v-card-title>
              <span class="text-h5">Actualizar Registro</span>
          </v-card-title>
          <v-card-text>
              <v-container>
                <v-row>
                  <v-col
                    cols="12"
                    sm="6"
                    md="4"
                  >
                 
                  
                <v-text-field
                      v-model="editedItem.descripcion"
                      label="Descripcion"
                    ></v-text-field>
                  </v-col>
                  <v-col
                    cols="12"
                    sm="6"
                    md="4"
                  >
                    <v-menu
      ref="menu3"
      v-model="menu3"
      :close-on-content-click="false"
      :nudge-right="40"
      :return-value.sync="time"
      transition="scale-transition"
      offset-y
      max-width="290px"
      min-width="290px"
    >
      <template v-slot:activator="{ on, attrs }">
        <v-text-field
          v-model="editedItem.start"
          label="Comienza"
          
          readonly
          v-bind="attrs"
          v-on="on"
        ></v-text-field>
      </template>
      <v-time-picker
        v-if="menu3"
        v-model="editedItem.start"
        full-width
        @click:minute="$refs.menu3.save(editedItem.start)"
      ></v-time-picker>
                   </v-menu>
                  </v-col>
                  <v-col
                    cols="12"
                    sm="6"
                    md="4"
                  >
                  <v-menu
      ref="menu4"
      v-model="menu4"
      :close-on-content-click="false"
      :nudge-right="40"
      :return-value.sync="time"
      transition="scale-transition"
      offset-y
      max-width="290px"
      min-width="290px"
    >
      <template v-slot:activator="{ on, attrs }">
        <v-text-field
          v-model="editedItem.end"
          label="Termina"
          
          readonly
          v-bind="attrs"
          v-on="on"
        ></v-text-field>
      </template>
      <v-time-picker
        v-if="menu4"
        v-model="editedItem.end"
        full-width
        @click:minute="$refs.menu4.save(editedItem.end)"
      ></v-time-picker>
                  </v-menu>
                  </v-col>
                  
                </v-row>
              </v-container>
         </v-card-text>
         <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn
                color="blue darken-1"
                text
                @click="close"
              >
                Cancelar
              </v-btn>
              <v-btn
                color="blue darken-1"
                text
               
                @click="update"
              >
               Guardar
              </v-btn>
            </v-card-actions>

        </v-card>
      
      
      </v-dialog>










        <v-dialog v-model="dialogDelete" max-width="500px">
          <v-card>
            <v-card-title class="text-h5">¿Estas seguro de eliminar este registro?</v-card-title>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="blue darken-1" text @click="closeDelete">Cancelar</v-btn>
              <v-btn color="blue darken-1" text @click="deleteregister">OK</v-btn>
              <v-spacer></v-spacer>
            </v-card-actions>
          </v-card>
        </v-dialog>
      </v-toolbar>
    </template>
    <template v-slot:item.actions="{item}">
      <v-icon
        small
        class="mr-2"
        @click="editItem(item)"
      >
        mdi-pencil
      </v-icon>
      <v-icon
        small
        @click="deleteItem(item)"
      >
        mdi-delete
      </v-icon>
    </template>
  
  </v-data-table>
</template>
<script>
export default {
	middleware: 'isadmin',
      data (){
    return {
    time: null,
     menu2: false,
     menu22:false,
     menu3: false,
     menu4:false,
    modal2: false,
    dialog: false,
    dialogDelete: false,
    dialogupdate:false,
  
    headers: [
      {
        text: 'Descripcion',
        align: 'start',
        sortable: false,
        value: 'descripcion',
      },
      { text: 'Comienza', value: 'start' },
      { text: 'Finaliza', value: 'end' },
  
      { text: 'Actions', value: 'actions', sortable: false },
    ],
    desserts: [],
    editedIndex: -1,

  // editar registros desde la api  
    editedItem: {
      descripcion: '',
     start:'',
      end : '',
     
    },
    defaultItem: {
      descripcion: '',
     start:'',
      end :'',
    },
  }},

  computed: {
    formTitle () {
      return this.editedIndex === -1 ? 'Nuevo Registro' :'Editar Registro'
    },
   
  },

  watch: {
    dialog (val) {
      val || this.close()
    },
    dialogDelete (val) {
      val || this.closeDelete()
    },
    dialogupdate(val){
    val || this.close()
    },
  },

  created () { 
    this.initialize()
  },

  methods: {
// desde axios realizo el request a la api
    initialize () {
  this.$axios.get('api/horarios/{horariosadmin}',
     {
    
     }).then((val)=>{
     this. desserts=val.data;
    
  }).catch(error=>{
    console.log(error)
  });
    




      
    },
// funcion del boton icono editar
    editItem (item) {
    this.editedIndex = this.desserts.indexOf(item)
    this.editedItem = Object.assign({}, item)
      this.dialogupdate = true
    },
// funcion del boton icono borrar
    deleteItem (item) {
      this.editedIndex = this.desserts.indexOf(item)
      this.editedItem = Object.assign({}, item)
      this.dialogDelete = true
    },

    deleteItemConfirm () {
      this.desserts.splice(this.editedIndex, 1)
      this.closeDelete()
    },
//cerrar modal de editar
    close () {
      this.dialog = false
      this.dialogupdate=false
      this.$nextTick(() => {
        this.editedItem = Object.assign({}, this.defaultItem)
        this.editedIndex = -1
      })
    },
// cerrar modal de borrar
    closeDelete () {
      this.dialogDelete = false
      this.$nextTick(() => {
        this.editedItem = Object.assign({}, this.defaultItem)
        this.editedIndex = -1
      })
    },
//metodo update-- desde la api.
async     update () {

        Object.assign(this.desserts[this.editedIndex], this.editedItem)
        try {
                   let errors = []
                 await this.$axios.$get('sanctum/csrf-cookie')
                   await this.$axios.put('api/horarios/{update}', {
                   'id':this.editedItem.id,
                   'descripcion':this.editedItem.descripcion,
                   'start':this.editedItem.start,
                   'end':this.editedItem.end


                   } )
                       .then((resp) => {
                          this.initialize();
                       })
                      
                       .catch((err) => {
                           if (err.response.status = 422) {
                               errors = err.response.data.errors
                               console.log(errors);
                           }
                       }).finally(()=>{
                       // loader stop
                       
                       this.$swal(" registro actualizado")
                         });
                       this.errors = errors
                 
               } catch (error) {
                   
               }
        

     
   this.close();






     
    
    },

 
     async   deleteregister(){//Esta nos abrirá un alert de javascript y si aceptamos borrará la tarea que hemos elegido
              let me =this;
              
              Object.assign(this.desserts[this.editedIndex], this.editedItem)
        try {
                   let errors = []
                 await this.$axios.$get('sanctum/csrf-cookie')
                   await this.$axios.$delete('api/horarios/{id}', {params: {'id': this.editedItem.id}
                   
                })
                       .then((resp) => {
                          
                       })
                      
                       .catch((err) => {
                           if (err.response.status = 422) {
                               errors = err.response.data.errors
                               console.log(errors);
                           }
                       }).finally(()=>{
                       // loader stop
                       
                       this.$swal(" registro eliminado")
                         });
                       this.errors = errors
                 
               } catch (error) {
                   
               }
        
               this.closeDelete () 
               this.initialize();
   

             
          },



  
  async register() {
      if (this.editedIndex > -1) {
            Object.assign(this.desserts[this.editedIndex], this.editedItem)
      } else {
 


               try {
                   let errors = []
                 await this.$axios.$get('sanctum/csrf-cookie')
                   await this.$axios.$post('api/horarios', this.editedItem)
                       .then((resp) => {})
                      
                       .catch((err) => {
                           if (err.response.status = 422) {
                               errors = err.response.data.errors
                               console.log(errors);
                           }
                       }).finally(()=>{
                       // loader stop
                       
                       this.$swal("Has agregado un horario")
                         });
                       this.errors = errors
                 
               } catch (error) {
                   
               }
              }
              
              this.initialize ();
              this.close();
         
       
        },
  },
}
</script>