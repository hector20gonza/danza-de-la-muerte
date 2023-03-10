<template>
   

    
    
 
<div class="container "  >
<v-navigation-drawer  
        app 
        floating   
        location="left" 
        class="bg-teal content right" 
         v-if="this.$auth.loggedIn"
         v-model="drawer"
        :rail="rail"
        permanent
        @click="rail = false"
   
   >
     <div  >
      <v-list-item >
        <v-list-item-content class="bg-3f888f" >
          <v-list-item-title class="text-h6">
            {{ this.$auth.user.name}}
          </v-list-item-title>
          <v-list-item-subtitle>
            Otra forma de ver la vida
            
          </v-list-item-subtitle> 
        </v-list-item-content>
      </v-list-item>
    </div>
      <v-divider></v-divider>
      
      <v-list>
      
  
      
        <div   >
        <v-list-item
          v-for="item in items"
          :key="item.title"
          link
          :to="`/${item.link}`"
 
        >
          <v-list-item-icon>
            
          <v-icon>{{ item.icon }}</v-icon>
        
          </v-list-item-icon>
  
          <v-list-item-content>
            <v-list-item-title>{{ item.title }}</v-list-item-title>
          </v-list-item-content>
        
        </v-list-item>
       </div>
      


    


    
   
    <div  v-if="this.$auth.user.is_admin" >
    
        <v-list-group 
        no-action 
        v-for='navLink1 in itemsadmin' 
        :key="navLink1.title"
        

        >
       
      <v-list-item slot='activator' >
            <v-list-item-icon>
            
            <v-icon>{{ navLink1.icon }}</v-icon>
        </v-list-item-icon>
    
        <v-list-item-content  >
           <v-list-item-title>{{ navLink1.title }}</v-list-item-title>
         </v-list-item-content>
       </v-list-item>
          <v-list-item v-for='sub in navLink1.subLinks' :key="sub.title" :to="sub.route">
                <v-list-item-icon  :to="sub.route">
                    <v-icon >{{ sub.icon }}</v-icon>
               </v-list-item-icon>
              <v-list-item-title >{{ sub.title }}</v-list-item-title>
            </v-list-item>
            
        </v-list-group>
                
       
       
      
      
    
    </div>
      </v-list>
</v-navigation-drawer>
</div>
</template>



<script>
 



 export default {
   data () {
    
     return {
      holis:'',
      drawer: true,
       items: [
         
         { link:'agendar',  title: 'Citas', icon: 'mdi-calendar' },
         {  link :'#', title: 'Tu Experiencia', icon: 'mdi-help-box' },
         {  link :'historialcitasusuario', title: 'Historial de citas', icon: 'mdi-history' },
        
         
        
       ],
    
    
       itemsadmin:[
       {  title: 'Administrar',icon:'mdi-table-settings',
           
           subLinks: [
                          { title: 'Citas', route:'Administrarcitas' , icon:'mdi-history' },
                          { title: "Horarios", route :'horarios' , icon:'mdi-store-clock-outline'},
                          { title: "Usuarios", route:'usuarios' , icon:'mdi-clipboard-account-outline'}
                          
                          
                      ]
         },
        
       ],
       
       rail: true,
       right: null,
     }
   },


   
   


//


   
        


//



 }


</script>
