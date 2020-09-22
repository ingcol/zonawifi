<template>
    <div class="container">
        <ul class="list-group">
         <li class="list-group-item"
            v-for="(item, index) in users" :key="index" >
          <span class="badge badge-primary float-right">
            {{item.updated_at}}
          </span>
          <p>{{item.name}}</p>
          <p>{{item.email}}</p>
          <p>

          </p>
        </li>
    </ul>
    </div>
</template>

<script>
    export default {
        data() {
    return {
      users: [],

    }
  },
   created(){
    axios.get('/users').then(res=>{
      this.users = res.data;
    })
  },
    }
</script>