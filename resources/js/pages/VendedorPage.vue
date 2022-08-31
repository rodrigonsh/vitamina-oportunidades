<template>

    <div class="container page" id="VendedorPage">

        <h1>Olá {{ user.name }}</h1>

        Listar oportunidades aqui

    </div>

</template>

<script>

    //import FormInput from "../components/FormInput.vue"

    export default
    {
      data()
      { 
        return {
          user: {
            name: 'Lorem IPSUM',
            email: 'lorem@ipsum.com.br',
          }
        }
      },
      mounted()
      {
        this.user = window.loggedUser
      }
    }

</script>