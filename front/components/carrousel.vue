<template>
    <v-carousel 
        cycle
        height="400"
        whidth="340"
        hide-delimiter-background
       
       :show-arrows="false"
       v-if="!this.$auth.loggedIn"
       >
      <v-carousel-item
        v-for="(item,i) in items"
        :key="i"
        :src="item.src"
        cover
      ></v-carousel-item>
    </v-carousel>
  </template>
 <script lang="ts">
  export default {
   
  
    data () {
      return {
        items: [
          {
            src: '/frase.png',
          },
          {
            src: 'https://cdn.vuetifyjs.com/images/carousel/sky.jpg',
          },
          {
            src: 'https://cdn.vuetifyjs.com/images/carousel/bird.jpg',
          },
          {
            src: 'https://cdn.vuetifyjs.com/images/carousel/planet.jpg',
          },
        ],
      }
    },
  }
</script>