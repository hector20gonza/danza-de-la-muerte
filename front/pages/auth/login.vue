<template>
  <div class="container mx-auto mt-10 sm:px-6 lg:px-8 flex ">
   
        
      <form @submit.prevent="login" class="bg-dark-500 rounded mx-auto px-6 py-6 w-1/2 ">
      
          
          <div class="flex flex-col mt-3" v-if="errors">
              <span class="text-red-200 italic">{{ errors }}</span>
          </div>
          <div class="flex flex-col mt-3">
              <label for="email" class="text-red-400 text-xl">Correo</label>
              <input type="email" v-model="form.email" class="px-2 py-1 rounded border" placeholder="Correo" >
          </div>
          <div class="flex flex-col mt-3">
              <label for="password" class="text-red-400 text-xl">Contraseña</label>
              <input type="password" v-model="form.password" class="px-2 py-1 rounded border" placeholder="Contraseña">
          </div>
          <div class="text-center mt-3">
              <teal-button type="submit">Inciar Sesion</teal-button>
          </div>
       
    
      </form>

  </div>
</template>
<script>
  export default {
      

      data:() => ({
          form: {
              email: '',
              password: ''
          },
          errors: ''
      }),
      methods: {
          async login() {
              try {
                  await this.$auth.loginWith('laravelSanctum', {data:this.form})
                  this.$swal("Bienvenido", this.$auth.user.name)
              } catch (err) {
                  if (err.response.status = 422) {
                  
                      this.$swal("No puede iniciar con esas credenciales",err.toString)
                  }
              }
                        
          }
      }
  }
</script>
  