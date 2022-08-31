<template>

    <div class="input-group mb-3">

        <label :for="'i-'+name" class="input-group-text">{{label}}</label>
        
        <input
            v-if="required"
            class="form-control"
            :type="type"
            :id="'i-'+name"
            :name="name"
            required="required"
        />

        <input
            v-else
            class="form-control"
            :type="type"
            :id="'i-'+name"
            :name="name"
        />


    </div>


</template>

<script>
export default {
  props: ['name', 'type', 'label', 'required']
}
</script>