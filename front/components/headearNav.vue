<template  >
    <div>
     <nav class="navbar navbar-expand-lg bg-#292a2c" permanent >
   <div class="container-fluid"  v-if="this.$auth.logout">
   <NuxtLink class="navbar-brand text-info" to="/">Danza con La Muerte</NuxtLink>   
     <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
       <span class="navbar-toggler-icon"></span>
     </button>

     <div class="collapse navbar-collapse" id="navbarNavDropdown">

      
       <template v-if="this.$auth.loggedIn">
      
      
  
         <ul class="navbar-nav">
         <li class="nav-item">
          <NuxtLink class="nav-link active text-info" aria-current="page" to="/">Quienes somos</NuxtLink>
         </li>
         <li class="nav-item">
          <NuxtLink class="nav-link active text-info" aria-current="page" to="/">Citas</NuxtLink>
         </li>
         <li class="nav-item">
          <NuxtLink class="nav-link active text-info" aria-current="page" to="/">Testimonios</NuxtLink>
         </li>
         
      </ul>
<template>
  <ul class="navbar-nav ms-auto">
        <li class="nav-item d-flex ">
      
        <a href="#" @click.prevent="logout" class="nav-link text-xl bg-red-300 border rounded">CERRAR SESION</a>
        </li>
  </ul>
</template>





    </template>
    <template v-else>
      <ul class="navbar-nav ms-auto">
        <li class="nav-item d-flex ">
        <NuxtLink class="nav-link text-xl bg-red-300 border rounded" to="/auth/login">INICIAR SESION</NuxtLink>
        </li>

          <li class="nav-item d-flex ">
        <NuxtLink class="nav-link  text-xl bg-red-300 border rounded" to="/auth/register">REGISTRARSE</NuxtLink>
        </li>
     </ul>
  
    </template>
     </div>
   </div>
 </nav>
    </div>
  </template>
  <script>
  export default {
    methods: {
        logout() {
            this.$auth.logout()
        }
    }
}
</script>