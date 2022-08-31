<template>

  <header>
    <h1>Olá {{ user.name }}</h1>
    <p>Estas são as oportunidades no sistema</p>
  </header>

  <div class="container page" id="VendedorPage">

      <FiltroOportunidades v-if="user.root" />

      <div id="oportunidades">

          <router-link to="/nova_oportunidade" class='oportunidade'>Cadastrar oportunidade</router-link>

          <div v-for="data in user.oportunidades">
              <Oportunidade :data="data" :root="user.root" />
          </div>
      </div>


  </div>

</template>

<script>

    import FiltroOportunidades from "../components/FiltroOportunidades.vue"
    import Oportunidade from "../components/Oportunidade.vue"

    export default
    {
      data()
      { 
        return {
          user: {
            name: '...',
            email: '...',
            root: false,
            oportunidades: []
          }
        }
      },
      mounted()
      {
        this.user = window.loggedUser
      },
      components: { FiltroOportunidades, Oportunidade }
    }

</script>

<style>

  header
  {
    padding: 32px;
    background: black;
    color: white;
    margin-bottom: 32px;
  }

  #oportunidades
  {
    display: flex;
    gap: 32px;
  }

</style>