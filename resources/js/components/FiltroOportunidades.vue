<template>

  <div class='filtro mb-4'>

    <div class="row">

      <div class="col-12 col-md-6">

        <div class="input-group">

          <label for="userFilter" class="input-group-text">🕵️‍♂️ Vendedor</label>
        
          <select
            id="userFilter"
            class="form-control"
            @change="filterByUser"
          >
            <option selected value="">Todos</option>
            <option v-for="opt in store.usuarios" :value="opt.id">{{opt.name}}</option>
          </select>

        </div>

      </div>
      
      <div class="col-12 col-md-6">

        <div class="input-group">

          <label for="userFilter" class="input-group-text">📅 Data</label>
        
          <input
            class="form-control"
            type="date"
            @change="filterByDate"
           />

        </div>

      </div>

    </div>

  </div>

</template>

<script>

  import {store} from "../store"

  export default {
    data(){ return { store, uid:"", date:"" } },
    props: ['data'],
    methods:
    {
      filterByUser(ev)
      {
        this.uid = ev.target.value
        this.filtrarOportunidades()
      },
      filterByDate(ev)
      {
        this.date = ev.target.value
        this.filtrarOportunidades()
      },
      filtrarOportunidades(ev)
      {

        let self = this
        
        if ( this.uid == "" && this.date == "" )
        {
          console.log( "No filter ... resetting" )
          store.user.oportunidades = store.user.backupOportunidades
          return
        } 

        store.user.oportunidades = []

        store.user.backupOportunidades.forEach( function(item)
        {

          let filterUser = (self.uid != "")
          let filterDate = (self.date != "")
          let sameUser = false
          let sameDate = false
          let isValid = false

          //console.log("filterUser", filterUser)
          //console.log("filterDate", filterDate)
          
          if ( filterUser && item.user_id == self.uid )
          {
            sameUser = true
          }

          // Testar a data ... pelo inicio da string
          if ( filterDate && item.created_at.startsWith( self.date ))
          {
            sameDate = true
          }

          if ( filterUser && sameUser && filterDate && sameDate )
          {
            //console.log('PERFECT MATCH')
            isValid = true
          }
          
          else
          {           
            if ( filterUser && sameUser && !filterDate ) isValid = true
            if ( filterDate && sameDate && !filterUser ) isValid = true 
          }
          
          if ( isValid ) store.user.oportunidades.push( {...item})

        })

      }
    },
    created()
    {
      store.user.backupOportunidades = [...store.user.oportunidades]
    }
  }
</script>

<style>
  .filtro
  { 
    background: #3e3e3e;
    color: white;
    padding: 32px;
  }

  @media ( max-width: 767px )
  {
    .filtro .col-12
    {
      margin-bottom: 8px;
    }
  }

</style>