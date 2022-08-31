<template>

  <header>
    <h1>Novo Produto</h1>
  </header>

  <div class="container page" id="NovoProdutoPage">

    <form @submit.prevent="save">

      <FormInput
        name="nome"
        type="text"
        required="true"
        label="Nome do Produto"
      />

      <button class="btn btn-primary">Salvar Produto</button>

    </form>

  </div>

</template>
  
  <script>

import FormInput from "../components/FormInput.vue"
import { store } from "../store.js"

export default
  {
    data() {
      return { store }
    },
    components: { FormInput },
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

          let prod = JSON.parse(xhr.responseText)
          self.store.produtos[prod.id] = prod

          self.$router.back()
        })
        xhr.open("post", "/novo_produto")
        xhr.send(fm)

      }
    }
  }

</script>

