<template>

<nav class="navbar navbar-dark bg-primary navbar-expand-md">
  <div class="container-fluid">
    
    <router-link :to="homeLink" class="navbar-brand"><strong>Oportunidades</strong></router-link>
    
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse ms-auto" id="navbarSupportedContent"> 
      <ul class="navbar-nav ms-auto mb-lg-0">

        <li class="nav-item">
          <router-link to="/about" class="nav-link">Saiba Mais</router-link>
        </li>

        <li v-if="store.user != null" class="nav-item">
          <router-link to="/produtos" class="nav-link">Produtos</router-link>
        </li>

        <li v-if="store.user != null" class="nav-item">
          <router-link to="/clientes" class="nav-link">Clientes</router-link>
        </li>
        
        <li v-if="store.user != null" class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <strong>{{ store.user.name }}</strong>
          </a>
          <ul class="dropdown-menu dropdown-menu-end">
            <li @click="this.logout()"><a class="dropdown-item" >Logout</a></li>
            <li><hr class="dropdown-divider"></li>
            <li @click="this.else()"><a class="dropdown-item" >Something else</a></li>
          </ul>
        </li>

        <!--li class="nav-item">
          <a class="nav-link disabled">Disabled</a>
        </li-->

      </ul>
    </div>

  </div>
</nav>

</template>

<script>

  import { store } from "../store.js"

  export default {
    data()
    {
      return { store }
    },
    computed:
    {
      homeLink() {
        return ( this.store.user == null ) ? "/" : "/user";
      }
    },
    methods:{
      logout()
      {
        this.store.user = null;
        this.$router.go(-1000)
      },
      else() { this.$router.push("/else") }
    }
  }
</script>

<style>
.nav-link{ color: white; }
</style>