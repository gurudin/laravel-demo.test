<template>
<div class="card w-75">
  <h5 class="card-header">
    Select a group before continue
  </h5>

  <div class="card-body">
    <div class="list-group text-center">
      <a class="list-group-item list-group-item-action"
      v-for="item in groupItem"
      :href="'/admin#/welcome?group=' + item.id">{{item.name}}</a>
    </div>
  </div>

  <div class="card-footer text-muted text-right">
    © MeMe Administration 2018
  </div>
  
</div>
</template>

<script>
export default {
  data() {
    return {
      groupItem: {},
    };
  },
  created() {
    var _this = this;
    this.GLOBAL.api.getAuthGroup().then(res =>{
      _this.groupItem = res.body.data;
      
      $.setCookie('group', JSON.stringify(res.body.data, 3 * 24 * 60));
    });
    
  }
};
</script>

