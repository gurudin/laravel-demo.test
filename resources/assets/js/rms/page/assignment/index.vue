<template>
<div class="view">
  <div class="col-12">
    <div class="row justify-content-between">
      <div class="col-4 h3">{{ $t("assignment.assignment") }}</div>

      <div class="col-4 text-right"></div>
    </div>
  </div>

  <div class="col-12">
    <table class="table table-hover">
      <thead class="thead-light">
        <tr>
          <th>#</th>
          <th>{{ $t("assignment.nick") }}</th>
          <th>{{ $t("assignment.email") }}</th>
          <th>{{ $t("assignment.group")}}</th>
          <th>{{ $t("common.action") }}</th>
        </tr>
      </thead>

      <tbody>
        <tr v-for="(user,inx) in userItem">
          <td>{{inx + 1}}</td>
          <td>{{user.name}}</td>
          <td>{{user.email}}</td>
          <td>
            <p v-for="group in user.group">{{group.name}} </p>
            <span v-if="!user.group" class="text-danger">{{$t('common.not-set')}}</span>
          </td>
          <td>
            <router-link
              class="btn btn-info btn-sm"
              :to="{path: '/assignment-view/' + user.id }"
              v-if="user.group">
              <i class="fas fa-eye"></i>
            </router-link>
          </td>
        </tr>
      </tbody>

    </table>
  </div>
</div>
</template>

<script type="text/x-template" id="hello">
  <p>Hello hello hello</p>
</script>

<script>
export default {
  data() {
    return {
      userItem: {}
    };
  },
  created() {
    var _this = this;
    this.GLOBAL.api.getAuthUser(this.GLOBAL.user.groupId).then(res => {
      _this.userItem = res.body.data;
    });
  }
};
</script>

