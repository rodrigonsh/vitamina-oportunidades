<template>

  <header>
    <h1>Nova Oportunidade</h1>
  </header>

  <div class="container page" id="NovaOportunidadePage">

    <form @submit.prevent="save">

      <FormSelect
        name="cliente_id"
        required="true"
        :options="store.clientes"
        label="Cliente"
      />

      <FormSelect
        name="produto_id"
        required="true"
        :options="store.produtos"
        label="Produto"
      />

      <button class="btn btn-primary">Salvar Oportunidade</button>

    </form>

  </div>

</template>
  
  <script>

import FormSelect from "../components/FormSelect.vue"
import { store } from "../store.js"

export default
  {
    data() {
      return { store }
    },
    components: { FormSelect },
    methods: {
      save(ev) {
        let self = this
        let fm = new FormData(ev.target)
        let token = document.querySelector('meta[name="csrf-token"]').content

        fm.append('_token', token)

        let xhr = new XMLHttpRequest();
        xhr.addEventListener('load', function () {
          if (xhr.responseText == "SHIT") {
            alert("Erro ao Salvar")
            return
          }

          let oportunidade = JSON.parse(xhr.responseText)
          store.user.oportunidades.push(oportunidade)

          self.$router.push('/user')
        })
        xhr.open("post", "/nova_oportunidade")
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
</style>