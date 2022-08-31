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

        <li v-if="user != null" class="nav-item">
          <router-link to="/produtos" class="nav-link">Produtos</router-link>
        </li>

        <li v-if="user != null" class="nav-item">
          <router-link to="/clientes" class="nav-link">Clientes</router-link>
        </li>
        
        <li v-if="user != null" class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <strong>{{ user.name }}</strong>
          </a>
          <ul class="dropdown-menu dropdown-menu-end">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
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
  export default {
    computed:
    {
      homeLink() {
        console.log('this.user', this.user)
        return ( this.user == null ) ? "/" : "/user";
      }
    },
    props: ['user']
  }
</script>

<style>
.nav-link{ color: white; }
</style>