<template>

    <div class="page" id="HomePage">

        <h1 class="mb-0">Bem vindo!</h1>

        <p class="mb-4">Para gerenciar suas oportunidades faça login</p>

        <form @submit.prevent="doLogin">

            <input type="hidden" name="csrf_token" value="test" />

            <FormInput
                type="email"
                name="email"
                label="Email"
            ></FormInput>
            
            <FormInput
                type="password"
                name="password"
                label="Senha"
            ></FormInput>

            <button class="btn btn-primary">Vai papai</button>

        </form>


    </div>


</template>

<script>

    import FormInput from "../components/FormInput.vue"

    export default
    {
      data()
      { 
        return {
          count: 0
        }
      },
      components: { FormInput },
      methods: { 
        doLogin(ev)
        {
            let fm = new FormData(ev.target)
            console.log("HUM", Object.fromEntries(fm))
        }
       }
    }
  
</script>

<style>

    #HomePage
    {
        height: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        max-width: 500px;
        margin: 0px auto;
    }

</style>