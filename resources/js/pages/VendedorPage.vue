<template>

  <header v-if="!store.user.root" id="VendedorHeader">
    <h1>Olá {{ store.user.name }}</h1>
    <p>Estas são as oportunidades no sistema</p>
  </header>

  <FiltroOportunidades v-if="store.user && store.user.root" />

  <div class="container page" id="VendedorPage">


      <div v-if="store.user" id="oportunidades">

          <router-link v-if="!store.user.root" to="/nova_oportunidade" class='novaOportunidade'>+ Cadastrar oportunidade</router-link>

          <div v-for="data in store.user.oportunidades">
              <Oportunidade :data="data" :root="store.user.root" />
          </div>
      </div>

  </div>

</template>

<script>

    import FiltroOportunidades from "../components/FiltroOportunidades.vue"
    import Oportunidade from "../components/Oportunidade.vue"
    import {store} from "../store.js"

    export default
    {
      data()
      { 
        return {store}
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

  header#VendedorHeader{ margin-bottom: 0px; }

  #oportunidades
  {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 32px;
    margin-bottom: 32px;
  }

  @media ( max-width: 700px ){
    #oportunidades{ grid-template-columns: repeat(2, 1fr); }
  }

  @media ( max-width: 500px ){
    #oportunidades{ grid-template-columns: repeat(1, 1fr); }
  }

  .novaOportunidade
  {
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    padding: 32px;
    background: #0d6efd;;
    color: white;
    font-size: 24px;
    font-weight: bold;
    border-radius: 6px;
    text-decoration: none;
    box-shadow: 0px 2px 3px #00000075;
    transition: all 0.2s;
    }

  .novaOportunidade:hover
  {
    color: yellow; 
    box-shadow: 0px 2px 10px #00000075;
  }

</style>