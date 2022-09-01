<template>

    <ul class="listView">

        <li v-for="r in this.rows">
            <div>
                <strong>{{ r[this.col] }}</strong>
            </div>
            <div v-if="!this.store.user.root" class="actions">
                <button class="btn btn-light">✍🏼</button>
                <button class="btn btn-light">🗑</button>
            </div>
        </li>

    </ul>

</template> 

<script>

import {store} from "../store"

export default {
  data(){ return { store } },
  props: [ 'col', 'rows' ]

}



</script>


<style>

    .listView
    {
        padding: 0px;
    }

    .listView li
    {
        display: flex;
        align-items: center;
        padding: 8px 0px;
        border-bottom: 1px solid #eee;
    }

    .listView div
    {
        flex-grow: 1
    }

    .listView .actions
    {
        flex-grow: 0;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 8px;
    }


</style>