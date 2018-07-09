<template>
<div class="view">
  <div class="col-12">
    <div class="row justify-content-between">
      <div class="col-4 h3">{{ $t("menu.menu") }}</div>

      <div class="col-4 text-right">
        <router-link :to="{path: '/menu-create'}" class="btn col-4 btn-success">
          {{ $t("common.create") }}
        </router-link>
      </div>
    </div>
  </div>

  <div class="col-12">
    <table class="table table-hover">
      <thead class="thead-light">
        <tr>
          <th scope="col">#</th>
          <th scope="col">{{ $t("menu.title") }}</th>
          <th scope="col">{{ $t("menu.order") }}</th>
          <th scope="col">{{ $t("menu.route") }}</th>
          <th scope="col">{{ $t("menu.parent") }}</th>
          <th scope="col">{{ $t("menu.data") }}</th>
          <th scope="col">{{ $t("common.action") }}</th>
        </tr>
      </thead>

      <tbody>
        <tr v-for="(item,inx) in menuItem">
          <th scope="row">{{item.id}}</th>
          <td>{{item.title}}</td>
          <td>{{item.order}}</td>
          <td>{{item.route ? item.route : '(not set)'}}</td>
          <td>{{item.parent_name ? item.parent_name : '(not set)'}}</td>
          <td>{{item.data ? item.data : '(not set)'}}</td>
          <td>
            <router-link :to="{path: '/menu-edit/' + item.id}" class="btn btn-warning btn-sm">
              <i class="fas fa-edit"></i>
            </router-link>
            <button type="button" class="btn btn-danger btn-sm" @click="delMenu($event, inx, item)"><i class="fas fa-trash-alt"></i></button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
</template>

<script>
import api from '../../api';
import { mapState, mapActions } from "vuex";

export default {
  computed: mapState({
    menuItem: state => state.menu.menuItem,
  }),
  created() {
    this.getMenuList();
  },
  methods: {
    ...mapActions(["getMenuList"]),
    delMenu(event, inx, item) {
      if (!confirm(this.$t('common.are-you-sure-to-delete-this-item'))) {
        return false;
      }

      var $btn = $(event.currentTarget);
      $btn.loading('<i class="fas fa-spinner fa-spin"></i>');
      
      var _this = this;
      api.deleteMenu(item.id).then(function (res) {
        $btn.loading('reset');
        if (res.body.status) {
          _this.menuItem.splice(inx, 1);
        } else {
          alert(res.body.msg);
        }
      });
    }
  }
};
</script>
