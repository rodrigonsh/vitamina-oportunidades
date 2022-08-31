<template>

    <div class="input-group mb-3">

        <label :for="'i-'+name" class="input-group-text">{{label}}</label>
        
        <select
            v-if="required"
            class="form-control"
            :id="'i-'+name"
            :name="name"
            required="required"
        >
        <option disabled selected value="">Selecione</option>
        <option v-for="opt in options" :value="opt.id">{{opt.nome}}</option>
        </select>


        <select
            v-else
            class="form-control"
            :id="'i-'+name"
            :name="name"
        >
        <option selected disabled value="">Selecione</option>
        <option v-for="opt in options" :value="opt.id">{{opt.nome}}</option>
        </select>


    </div>


</template>

<script>
export default {
  props: ['name', 'label', 'required', 'options']
}
</script>