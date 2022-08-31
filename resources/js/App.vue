
<script>

  import ComponenteTeste from "./components/ComponenteTeste.vue"
  import NavBar from "./components/NavBar.vue"
  import Footer from "./components/Footer.vue"
  import { store } from './store'

  export default
  {

    data()
    { 
      return {
        store
      }
    },

    components: {
      ComponenteTeste,
      NavBar,
      Footer
    },

  }

 </script>

<template>

  <NavBar />

  <main>
    <router-view></router-view>        
  </main>

  <Footer />

</template>