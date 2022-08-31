<template>

  <header>
    <h1>Cliente: {{ store.clientes[op.cliente_id].nome }}</h1>
  </header>

  <div class="container page" id="OportunidadePage">

    <!--h2>Vendedor: {{ oportunidade.user_id }}</h2-->
    <h2>Produto: {{ store.produtos[op.produto_id].nome }}</h2>
    <p>Data: {{ op.data }}</p>

    <div id="acoes" v-if="op.status == null">

      <button class="btn text-bg-danger p-3 fs-5" @click="updateOportunidade" data-enum="perdida">😭 Rejeitar</button>
      <button class="btn text-bg-success p-3 fs-5" @click="updateOportunidade" data-enum="vencida">🏆 Aceitar</button>

    </div>

    <div v-else>
      
      <p>Status: <strong>{{ getStatus() }}</strong></p>

      <button class='btn btn-primary' @click="$router.back()">&lt; Voltar</button>

    </div>

  </div>

</template>

<script>

  import { store } from "../store.js"

  export default
  {

    data(){ return { store } },
    created()
    {
      let self = this
      let id = this.$route.params.id
      this.op = {}
      this.store.user.oportunidades.forEach(function(op)
      {
        if ( op.id == id )
        {
          self.op = op
          let data = new Date(op.created_at)
          self.op.data = data.toLocaleDateString('pt-BR')
        }
      })
    },
    methods:
    {
      getStatus()
      {
        if ( this.op.status == 'perdida' ) return "Perdida 😭";
        if ( this.op.status == 'vencida' ) return "Vencida 🏆";
        return "WTF 🤯"
      },
      updateOportunidade(ev)
      {
        let self = this
        let fm = new FormData()
        let token = document.querySelector('meta[name="csrf-token"]').content
        fm.append('status', ev.target.dataset.enum)
        fm.append('_token', token)
        
        let xhr = new XMLHttpRequest();
        xhr.addEventListener('load', function () {

          if (xhr.responseText == "SHIT") {
            alert("Erro ao Atualizar Status")
            return
          }

          self.store.user.oportunidades.forEach(function(op)
          {
            console.log(op.id, self.$route.params.id)
            if ( op.id == self.$route.params.id )
            {
              op.status = ev.target.dataset.enum
            }
          })

          self.$router.push('/user')

        })
        xhr.open("post", "/oportunidade/"+self.op.id+"/updateStatus")
        xhr.send(fm)

      }
    }
  }

</script>

  
<style>
header {
  padding: 32px;
  background: black;
  color: white;
  margin-bottom: 32px;
}

#acoes
{
  margin-top: 32px;
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 32px;
}

</style>