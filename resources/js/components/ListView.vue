<template>

    <ul class="listView">

        <li v-for="r in rows">
            <div>
                <strong>{{ r[col] }}</strong>
            </div>
            <div class="actions">
                <button class="btn btn-light">✍🏼</button>
                <button class="btn btn-light">🗑</button>
            </div>
        </li>

    </ul>

</template>

<script>

export default {
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