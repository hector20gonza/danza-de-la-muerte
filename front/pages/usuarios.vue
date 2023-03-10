<template>
	<v-data-table
	  :headers="headers"
	  :items="desserts"
	  sort-by="calories"
	  class="elevation-1"
	>
	  <template v-slot:top>
		<v-toolbar
		  flat
		>
		  <v-toolbar-title>Administracion de Usuarios</v-toolbar-title>
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
				Crear Usuario
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
						v-model="editedItem.name"
						label="Nombre"
					  ></v-text-field>
					</v-col>
					<v-col
					  cols="12"
					  sm="6"
					  md="4"
					>
					  <v-text-field
						v-model="editedItem.username"
						label="Usuario"
					  ></v-text-field>
					</v-col>
					<v-col
					  cols="12"
					  sm="6"
					  md="4"
					>
					  <v-text-field
						v-model="editedItem.email"
						label="Correo"
					  ></v-text-field>
					</v-col>
					<v-col
					  cols="12"
					  sm="6"
					  md="4"
					>
					  <v-text-field
						v-model="editedItem.rol"
						label="Rol"
					  ></v-text-field>
					</v-col>
					<v-col
					  cols="12"
					  sm="6"
					  md="4"
					>
					  <v-text-field
						v-model="editedItem.password"
						type="password"
						label="password"
					  ></v-text-field>
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
				  @click="register"
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
						v-model="editedItem.name"
						label="Nombre"
					  ></v-text-field>
					</v-col>
					<v-col
					  cols="12"
					  sm="6"
					  md="4"
					>
					  <v-text-field
						v-model="editedItem.username"
						label="Usuario"
					  ></v-text-field>
					</v-col>
					<v-col
					  cols="12"
					  sm="6"
					  md="4"
					>
					  <v-text-field
						v-model="editedItem.email"
						label="Correo"
					  ></v-text-field>
					</v-col>
					<v-col
					  cols="12"
					  sm="6"
					  md="4"
					>
					  <v-text-field
						v-model="editedItem.rol"
						label="Rol"
					  ></v-text-field>
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
			  <v-card-title class="text-h5">¿Estas seguro de eliminar a este usuario?</v-card-title>
			  <v-card-actions>
				<v-spacer></v-spacer>
				<v-btn color="blue darken-1" text @click="closeDelete">Cancel</v-btn>
				<v-btn color="blue darken-1" text @click="deleteregister">OK</v-btn>
				<v-spacer></v-spacer>
			  </v-card-actions>
			</v-card>
		  </v-dialog>
		</v-toolbar>
	  </template>
	  <template v-slot:item.actions="{ item }">
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
	  <template v-slot:item.is_admin="{item}">

                           
<v-chip
small
  class="ma-2"
  color="green"
  text-color="white"
  v-if="item.is_admin===1"
 >
Admin
</v-chip>
<v-chip
small
  class="ma-2"
  color="blue"
  text-color="white"
  v-if="item.is_admin===0"
 >
Usuario
</v-chip>

      </template>
	  </v-data-table>
  </template>
  <script>
     export default {
		middleware: 'isadmin',
       data: () => ({
      dialog: false,
      dialogDelete: false,
	  dialogupdate:false,
	  password:'',
      headers: [
        {
          text: 'ID',
          align: 'start',
          sortable: false,
          value: 'id',
        },
        { text: 'NOMBRE', value: 'name' },
        { text: 'USUARIO', value: 'username' },
        { text: 'CORREO', value: 'email' },
        { text: 'ROl ', value: 'is_admin' },
		{ text: 'CREADO', value: 'created_at' },
        { text: 'Actions', value: 'actions', sortable: false },
      ],
      desserts: [],
      editedIndex: -1,
	 
      editedItem: {
        id:'',
        name: '',
        username:'',
		email:'',
        created_at:'',
        rol: '',
		password:'',
      },
      defaultItem: {
        id: '',
        name: '',
        username:'',
		email:'',
        created_at: '',
        rol: '',
      },
    }),

    computed: {
      formTitle () {
        return this.editedIndex === -1 ? 'Nuevo Usuario' : 'Editar Usuario'
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
      initialize () {
        
	this.$axios.get('/api/users'
    ).then((val)=>{
       this. desserts=val.data;
      
    }).catch(error=>{
      console.log(error)
    });





      },

      editItem (item) {
    this.editedIndex = this.desserts.indexOf(item)
    this.editedItem = Object.assign({}, item)
      this.dialogupdate = true
    },

      deleteItem (item) {
        this.editedIndex = this.desserts.indexOf(item)
        this.editedItem = Object.assign({}, item)
        this.dialogDelete = true
      },

      deleteItemConfirm () {
        this.desserts.splice(this.editedIndex, 1)
        this.closeDelete()
      },

	  close () {
      this.dialog = false
      this.dialogupdate=false
      this.$nextTick(() => {
        this.editedItem = Object.assign({}, this.defaultItem)
        this.editedIndex = -1
      })
    },

      closeDelete () {
        this.dialogDelete = false
        this.$nextTick(() => {
          this.editedItem = Object.assign({}, this.defaultItem)
          this.editedIndex = -1
        })
      },

      save () {
        if (this.editedIndex > -1) {
          Object.assign(this.desserts[this.editedIndex], this.editedItem)
        } else {
          this.desserts.push(this.editedItem)
        }
        this.close()
      },
	  async register() {
      if (this.editedIndex > -1) {
            Object.assign(this.desserts[this.editedIndex], this.editedItem)
      } else {
               try {
                   let errors = []
                 await this.$axios.$get('sanctum/csrf-cookie')
                   await this.$axios.$post('api/users', this.editedItem)
                       .then((resp) => {})
                      
                       .catch((err) => {
                           if (err.response.status = 422) {
                               errors = err.response.data.errors
                               console.log(errors);
                           }
                       }).finally(()=>{
                       // loader stop
                       
                       this.$swal("Has agregado un usuario")
                         });
                       this.errors = errors
                 
               } catch (error) {
                   
               }
              }
              
              this.initialize ();
              this.close();
         
       
        },
		async     update () {

Object.assign(this.desserts[this.editedIndex], this.editedItem)
try {
		   let errors = []

		 await this.$axios.$get('sanctum/csrf-cookie')
		   await this.$axios.put('api/users/{update}', {
		   'id':this.editedItem.id,
		   'name':this.editedItem.name,
		   'username':this.editedItem.username,
		   'email':this.editedItem.email,
		   'password':this.editedItem.password

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
                   await this.$axios.$delete('api/users/{id}', {params: {'id': this.editedItem.id}
                   
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


    },
  }
</script>