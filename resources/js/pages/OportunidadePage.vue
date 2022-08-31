<template>

  <header>
    <h1>Oportunidade</h1>
  </header>

  <div class="container page" id="OportunidadePage">

    {{ id }}

  </div>

</template>

<script>
  export default
  {

    created()
    {
      this.id = this.$route.params.id
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