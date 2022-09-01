<template>

  <router-link :to="'/oportunidade/'+data.id" class='oportunidade' :status="data.status">
    <h3 v-if="root">Vendedor: {{ this.userName(data.user_id) }}</h3>
    <h3>Cliente: {{ this.clientName(data.cliente_id) }}</h3>
    <p class="mb-0">Produto: <strong>{{ this.productName(data.produto_id) }}</strong></p>
    <p>Data: <strong>{{ this.itemDate(data) }}</strong></p>
    Status: <strong>{{ this.getStatus(data) }}</strong>
  </router-link>

</template>

<script>

  import {store} from '../store.js'

  export default {
    data(){ return{ store } },
    props: ['data', 'root'],
    methods:
    {
      userName(id){ return store.usuarios[id].name },
      clientName(id){ return store.clientes[id].nome },
      productName(id){ return store.produtos[id].nome },

      itemDate(data)
      {
        let d = new Date(data.created_at);
        return d.toLocaleDateString('pt-BR') 
      },
      
      getStatus(data)
      {
        if ( data.status == null ) return "Em Aberto 😊";
        if ( data.status == 'perdida' ) return "Perdida 😭";
        if ( data.status == 'vencida' ) return "Vencida 🏆";
        return "WTF 🤯"
      }
    }
  }
</script>

<style>

  .oportunidade
  { 
    display: block;
    padding: 16px 24px;
    background: #f0f0f070;
    border-radius: 6px;
    text-decoration: none;
    color: black;
    box-shadow: 0px 2px 3px #00000075;
    transition: all 0.2s;
  }

  .oportunidade:hover{ box-shadow: 0px 2px 10px #00000075; }

  .oportunidade[status=vencida]
  {
    background-image: linear-gradient(313deg, rgba(255,216,0,1) 0%, rgba(255,160,0,1) 35%, rgba(255,210,0,1) 36%, rgba(255,240,204,1) 54%, rgba(237,185,0,1) 68%, rgba(255,236,138,1) 69%, rgba(255,230,27,1) 70%, rgba(255,230,27,1) 94%, rgba(255,229,0,1) 100%);
    color: white;
    text-shadow: 0px 3px 4px #000;
  }

  .oportunidade[status=perdida]
  {
    opacity: 0.5;
    color: red;
  }

  .oportunidade h3
  {
    font-size: 20px;
    font-weight: bold;
  }

</style>