<template>

    <div class="input-group mb-3">
        <label for="i-{{name}}" class="input-group-text">{{label}}</label>
        <input
            class="form-control"
            type="{{type}}"
            id="i-{{name}}"
            name="{{name}}"
            />
    </div>


</template>

<script>
export default {
  props: ['name', 'type', 'label'],
  created() {
    // props are exposed on `this`
    console.log(this.title)
  }
}
</script>