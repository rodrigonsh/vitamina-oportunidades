
<script>

  import ComponenteTeste from "./components/ComponenteTeste.vue"
  import NavBar from "./components/NavBar.vue"
  import Footer from "./components/Footer.vue"

  export default
  {

    data()
    { 
      return {
        count: 0,
        user: null
      }
    },

    components: {
      ComponenteTeste,
      NavBar,
      Footer
    },

    methods: { 
      userLogged(ev)
      {
        window.loggedUser = ev
        this.user = ev,
        this.$router.push("/user")        
      }
     }
  }

 </script>

<template>

  <NavBar :user="user" />

  <main>
    <router-view
      @userlogged="userLogged"
    >
    </router-view>        
  </main>

  <Footer />

</template>