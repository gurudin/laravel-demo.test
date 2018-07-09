<template>
<div class="view">
  <div class="col-12">
    <div class="row justify-content-between">
      <div class="col-4 h3">{{ $t("permission.permission") }}</div>

      <div class="col-4 text-right">
        <router-link :to="{path: '/permission-create'}" class="btn col-4 btn-success">
          {{ $t("common.create") }}
        </router-link>
      </div>
    </div>
  </div>

  <div class="col-12">
    <table class="table table-hover">
      <thead class="thead-light">
        <tr>
          <th>{{ $t("permission.name") }}</th>
          <th>{{ $t("permission.description") }}</th>
          <th>{{ $t("common.action") }}</th>
        </tr>
      </thead>

      <tbody>
        <tr>
          <td><input type="text" class="form-control" v-model="searchKey.name" :placeholder="$t('permission.name')"></td>
          <td><input type="text" class="form-control" v-model="searchKey.desc" :placeholder="$t('permission.description')"></td>
          <td></td>
        </tr>
        <tr v-for="(item,inx) in permissionItemData">
          <td>{{item.name}}</td>
          <td>{{item.description}}</td>
          <td>
            <router-link :to="{path: '/permission-view/' + encodeURIComponent(item.name)}" class="btn btn-primary btn-sm">
              <i class="fas fa-eye"></i>
            </router-link>
            <button type="button" class="btn btn-danger btn-sm" @click="deletePermission($event, inx, item)"><i class="fas fa-trash-alt"></i></button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
  {{permissionItem}}
</div>
</template>

<script>
import api from "../../api";
import { mapState, mapActions } from "vuex";

export default {
  data() {
    return {
      searchKey: { name: "", desc: "" }
    };
  },
  computed: mapState({
    permissionItem: state => state.authItem.permissionItem,
    permissionItemData() {
      var keyName = this.searchKey.name;
      var keyDesc = this.searchKey.desc;
      var data = this.permissionItem.permission;
      if (!data) {
        return [];
      }
    
      data = data.filter(row => {
        if (keyName) {
          var tmpName = String(row.name).indexOf(keyName) > -1;
        } else {
          var tmpName = true;
        }

        if (keyDesc) {
          var tmpDesc = String(row.name).indexOf(keyDesc) > -1;
        } else {
          var tmpDesc = true;
        }

        return tmpName && tmpDesc;
      });

      return data;
    }
  }),
  created() {
    this.getPermission();
  },
  methods: {
    ...mapActions(["getPermission"]),
    deletePermission(event, inx, item) {
      if (!confirm(this.$t("common.are-you-sure-to-delete-this-item"))) {
        return false;
      }

      var _this = this;
      var $btn = $(event.currentTarget);
      $btn.loading('<i class="fas fa-spinner fa-spin"></i>');
      api.deleteRoute(item.name).then(function(res) {
        if (res.body.status) {
          _this.permissionItem.splice(inx, 1);
        } else {
          alert(res.body.msg);
        }
        $btn.loading("reset");
      });
    }
  }
};
</script>

