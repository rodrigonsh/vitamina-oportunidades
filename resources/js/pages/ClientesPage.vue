<template>

    <div id="ClientesPage">

    <header>
        <h1>Clientes</h1>
        <router-link v-if="!store.user.root" to="/novo_cliente" class="btn btn-primary">+ Cliente</router-link>
    </header>

    <div class="container page">

        <ListView
            col="nome"
            :rows="rows"
        />

    </div>

    </div>

</template>


<script>

    import {store} from "../store"
    import ListView from "../components/ListView.vue"

    export default
    {
        data() {
            return {
                store,
                'rows': store.clientes,
            }
        },
        components: { ListView }
    }

</script>


<style>
  #ClientesPage header
  {
    display: flex;
    padding: 32px;
    background: black;
    color: white;
    margin-bottom: 32px;
  }

  #ClientesPage header h1{ flex-grow: 1; }
  #ClientesPage header a
  {
    display: flex;
    align-items: center; 
    justify-content: center;
  }

</style>
