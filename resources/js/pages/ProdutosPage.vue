<template>

    <div id="ProdutosPage">

    <header>
        <h1>Produtos</h1>
        <router-link to="/novo_produto" class="btn btn-primary">+ Produto</router-link>
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
                'rows': store.produtos,
            }
        },
        components: { ListView }
    }

</script>


<style>
  #ProdutosPage header
  {
    display: flex;
    padding: 32px;
    background: black;
    color: white;
    margin-bottom: 32px;
  }

  #ProdutosPage header h1{ flex-grow: 1; }
  #ProdutosPage header a
  {
    display: flex;
    align-items: center; 
    justify-content: center;
  }

</style>
