<template >
      <div>
            <v-dialog 
            v-model="dialogprincipal"
           width="600"
          >
         <template v-slot:activator="{ on, attrs }"  >
          <v-flex xs12 sm6 md4>
          <v-btn
            color="red "
            dark
            v-bind="attrs"
            v-on="on"
            block
            elevation="10"
            rounded
           >
            Reservar Hora
          </v-btn>
         </v-flex>
        </template>
      
 
      <v-card>
          <v-card-title class="text-h5 blue lighten-2">
          RESERVA TU HORA PARA DANZAR
          </v-card-title>
  
          <v-card-text>
           La muerte no recibe muchas personas a la misma hora, recuerda es solo una hora por persona
          </v-card-text>
         
              <form  @submit.prevent="register" method="POST"    >
              <v-text-field v-model="date" outlined dense hide-details>
               
               </v-text-field>








                

               
                 <v-date-picker
                 v-model="date"
                 type="date"
                 label="Fecha"
                 :min="hoy"
                 :language="es"
                 :allowed-dates="allowedDates"
                @input="gethorarioselect"
            
                 >
              </v-date-picker>
              
                
       <v-container fluid>
             <v-row class="center">
            <v-col cols="6"> 
               <v-subheader>
                 Horarios disponibles
               </v-subheader>
             </v-col>

           <v-col cols="col-2">
            <div class="col-10">
            <div class="form-group">
              
              <v-select
               v-model="form.hora_id"
               :items="horarios"
               label="Selecciona un horario"
               item-text="descripcion"
               item-value="id"
               :rules="[v => !!v || 'Es necesario que seleccione un horario']"
               required
               >
              </v-select>
              </div>
             </div>

           </v-col>
          
          </v-row>
        
        </v-container>
        <v-btn
				color="primary"
				dark
				class="mb-2"
				type="submit"
			  >
				Reservar
			  </v-btn>
      </form>
    
  
          <v-divider></v-divider>
  
          
        
        </v-card>
     
           </v-dialog>
     
    <v-card-title class=" blue ">
      <h2 >Horarios disponibles para el dia de hoy.</h2>
    </v-card-title>

    <v-divider></v-divider>
        
  
      <v-simple-table>
           <thead>
                  <tr>
                     <th class="text-h6 gray lighten-2"  >
                      Descripcion
                     </th>
                     <th class="text-h6 gray lighten-2" > 
                     Comienza
                     </th>
                     <th class="text-h6 gray lighten-2">
                     Termina
                     </th>
                     <th class="text-h6 gray lighten-2">
                     Estatus
                     </th>
                   </tr>
             </thead>
         <tbody>
                        <tr
                           v-for="hora in horariosdis"
                           :key="hora.id"
                        >
                              <td v-text="hora.descripcion " class="text-left" ></td>
                              <td v-text="hora.start " class="text-left" ></td>
                              <td v-text="hora.end " class="text-left" ></td>
                              <td class="text-left" v-if="hora.status==1" >
     
                              <v-chip
                                class="ma-2"
                                color="green"
                                text-color="white"
                               >
                               Disponible
                              </v-chip>
      
                              </td>
                             
        </tr>
    </tbody>

      </v-simple-table>

   
    </div>
   
</template>
 <script>
 
 export default {
  middleware: 'auth',
 
    data () {
      
      return {
        
        
        
            date:this.hoy,
         form:{
              hora_id:'',
              users_id:this.$auth.user.id,
              status:'1',
              fecha:'',
             
               },
       
          
          value: null,
          barra:false,
          dialogprincipal:false,
          horarios:[],
          horariosdis:[],
           hoy:'',
            
               
      } 
    },
   
  methods:{
  //---------------------------------
  

  allowedDates: val => ![5, 6].includes(new Date(val).getDay()),
   
   
    
  
    
//----------------------------------------
    async register() {
                 try {
                     let errors = []
                    
                   await this.$axios.$get('sanctum/csrf-cookie')
                     await this.$axios.$post('api/reservas', this.form)
                         .then((resp) => {
                          
                         
                          this.$swal('Saludos',resp.message);
                         
                         
                        })
                         
                         .catch((err) => {
                             if (err.response.status = 422) {
                                 errors = err.response.data.errors
                               //  console.log(errors);
                               
                             }
                         }).finally(()=>{
                         // loader stop
                         this.dialogprincipal=false;
                         this.$nuxt.$loading.finish();
                         this.gethorarios();
                        
                         
                     
                           });
                         this.errors = errors
                    
                 } catch (error) {
                     
                 }
         
    },
 
//------------------------------------------

gethorarioselect(){

  let dat, hora,min,horaactual

  dat = new Date()

  
      hora = dat.getHours();
      min = dat.getMinutes(); 
      horaactual=hora+':'+min;
      console.log(horaactual);
     
           this.$axios.get('api/horarios/{fecha}',{params:{fecha:this.form.fecha}}).then((val)=>{
           this.horarios=val.data;
           this.$swal(val.data.message); 
           }).catch(error=>{
           console.log(error)
           });
        
      

 },



//----------------------------------------
gethorarios(){
 
  this.$axios.get('api/horarios',
       {
       
       }).then((val)=>{
   
   this.horariosdis=val.data;
   this.$swal(val.data.message);
    }).catch(error=>{

      console.log(error)
    });
      
    

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
/* disabledates(){
  let dat, day,month, year, month1
  dat = new Date()
  day=dat.getDate().toLocaleString();
  
console.log(day)
return day
 },     */    

},



 created(){

this.gethorarios();
this.printDate();
//this.disabledates();
//this.allowedDates();
  },
 

  }
 

  </script>




 
