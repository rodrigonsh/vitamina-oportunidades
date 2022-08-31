<template>

    <div class="page" id="HomePage">

        
        <form @submit.prevent="doLogin">
            
            <h1 class="mb-0">Bem vindo!</h1>
            <p class="mb-4">Para gerenciar suas oportunidades faça login</p>

            <input type="hidden" name="csrf_token" value="test" />

            <FormInput
                type="email"
                name="email"
                label="Email"
                required="true"
            ></FormInput>
            
            <FormInput
                type="password"
                name="password"
                label="Senha"
                required="true"
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
            let self = this
            let fm = new FormData(ev.target)
            let token = document.querySelector('meta[name="csrf-token"]').content
            
            fm.append('_token', token)

            let xhr = new XMLHttpRequest();
            xhr.addEventListener('load', function()
            {
                let user = JSON.parse(xhr.responseText)
                self.$emit('user-logged', user)
            })
            xhr.open("post", "/login")
            xhr.send(fm)

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
        
        background-image: url(/img/login.jpg);
        background-position: center;
        background-size: cover;
        
    }
    
    #HomePage form
    {
        margin: 0px auto;
        max-width: 500px;
        background: rgba(255, 255, 255, 0.8);
        padding: 16px;
        border-radius: 3px;
        box-shadow: 0px 2px 3px #00000075;
        backdrop-filter: blur(10px);
    }

</style>