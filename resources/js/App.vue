
<script>

  import ComponenteTeste from "./components/ComponenteTeste.vue"
  import NavBar from "./components/NavBar.vue"
  import Footer from "./components/Footer.vue"

  export default
  {
    data()
    { 
      return {
        count: 0
      }
    },
    components: {
    NavBar,
    ComponenteTeste,
    Footer
},
    methods: { 
      doLogin(ev)
      {
          let fm = new FormData(ev.target)
          console.log("HUM", Object.fromEntries(fm))
      }
     }
  }

 </script>

<template>

  <NavBar />

  <main class="container p-3">
    <router-view></router-view>        
  </main>

  <Footer />

</template>