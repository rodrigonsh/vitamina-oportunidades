<template>

  <router-link :to="'/oportunidade/'+data.id" class='oportunidade'>
    <h3>Cliente: {{ this.clientName(data.cliente_id) }}</h3>
    <p>Produto: <strong>{{ this.productName(data.produto_id) }}</strong></p>
    <p>Data: <strong>{{ this.itemDate(data) }}</strong></p>
    Status: <strong>{{ this.getStatus(data) }}</strong>
  </router-link>

</template>

<script>
  export default {
    props: ['data', 'root'],
    methods:
    {
      userName(id){ return window.usuarios[id].nome },
      clientName(id){ return window.clientes[id].nome },
      productName(id){ return window.produtos[id].nome },

      itemDate(data)
      {
        let d = new Date(data.created_at);
        return d.toLocaleDateString('pt-BR') 
      },
      
      getStatus(data)
      {
        if ( data.status == null ) return "Em Aberto 😊";
        if ( data.status == 'perdida' ) return "Perdida 😭";
        if ( data.status == 'vencida' ) return "Vencida 😎";
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
    border: 1px solid #eee;
    background: #f0f0f070;
    border-radius: 3px;
    text-decoration: none;
    color: black;
  }

  .oportunidade h3
  {
    font-size: 20px;
    font-weight: bold;
  }

</style>