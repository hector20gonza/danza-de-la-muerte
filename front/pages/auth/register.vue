<template>
    <div class="container mx-auto mt-16 sm:px-6 lg:px-8">
         <form @submit.prevent="register" class="bg-teal-500 rounded mx-auto px-6 py-6 w-1/2">
             <div class="flex flex-col">
                 <label for="name" class="text-white text-xl ">Nombre</label>
                 <input type="text" v-model="form.name" class="px-2 py-1 rounded border" placeholder="Nombre">
                 <span class="text-red-200 italic"  v-if="errors.name">{{ errors.name[0] }}</span>
             </div>
             <div class="flex flex-col mt-3">
                 <label for="username" class="text-white text-xl">Username</label>
                 <input type="text" v-model="form.username" class="px-2 py-1 rounded border" placeholder="Username">
                 <span class="text-red-200 italic" v-if="errors.username">{{ errors.username[0] }}</span>
             </div>
             <div class="flex flex-col mt-3">
                 <label for="email" class="text-white text-xl">Correo</label>
                 <input type="email" v-model="form.email" class="px-2 py-1 rounded border" placeholder="Correo">
                 <span class="text-red-200 italic" v-if="errors.email">{{ errors.email[0] }}</span>
             </div>
             <div class="flex flex-col mt-3">
                 <label for="password" class="text-white text-xl">Contraseña</label>
                 <input type="password" v-model="form.password" class="px-2 py-1 rounded border" placeholder="Contraseña">
                 <span class="text-red-200 italic" v-if="errors.password">{{ errors.password[0]}}</span>

             </div>
             <div class="flex flex-col mt-3">
                 <label for="password_confirmation" class="text-white text-xl">Confirmar Contraseña</label>
                 <input type="password" v-model="form.password_confirmation" class="px-2 py-1 rounded border" placeholder="Confirmar contraseña">
             </div>
             <div class="text-center mt-3">
                 <teal-button type="submit">Registrarse</teal-button>
             </div>
         </form>
     </div>
 </template>
 
 <script>
     export default {
         
         data: ()=> ({
             form: {
                 name: '',
                 username: '',
                 email: '',
                 password: '',
                 password_confirmation: '',
             },
             errors: [],
         }),
         methods: {
            
            async register() {
                try {
                    let errors = []
                    await this.$axios.$get('sanctum/csrf-cookie')
                    await this.$axios.$post('/register', this.form)
                        .then((resp) => {
                            this.$swal('Registro exitoso');
                        })
                        .catch((err) => {
                            if (err.response.status = 422) {
                                errors = err.response.data.errors
                                this.$swal('Ha ocurrido un error, verifique los campos');
                            }
                        })
                        this.errors = errors
                    await this.$auth.loginWith('laravelSanctum', {data: this.form})
                } catch (error) {
                    
                }
            }
         }
     }
 </script>