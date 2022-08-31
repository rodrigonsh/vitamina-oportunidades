<template>

    <div class='teste'>
        <strong>RAPAIZZZ <span>{{ title }}</span></strong>
    </div>

</template>

<script>
export default {
  props: ['title'],
  created() {
    // props are exposed on `this`
    console.log(this.title)
  }
}
</script>

<style>
.teste{
    display: block;
    color: red;
}
</style>