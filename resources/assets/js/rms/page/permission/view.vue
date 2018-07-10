<template>
<div class="view">
  <div class="col-12">
    <div class="row justify-content-between">
      <div class="col-8 h3">{{ $t("permission.permission") }}: {{name}}</div>

      <div class="col-4 text-right">
        <router-link :to="{path: '/permission'}" class="btn col-4 btn-light">
          <i class="fa fa-arrow-left"></i> {{$t('common.back')}}
        </router-link>
      </div>
    </div>
  </div>

  <div class="row col-12">
    <div class="col">
      <div class="form-group">
        <input type="text" class="form-control" v-model="searchKey.route" :placeholder="$t('permission.search-for-routes')">
        <select multiple class="form-control" size="20" ref="select-route">
          <optgroup :label="$t('route.route')">
            <option v-for="route in routeData" :value="route.method+' '+route.name">{{route.method.toUpperCase()}} {{route.name}}</option>
          </optgroup>
        </select>
      </div>
    </div>

    <div class="col-2 text-center" style="margin-top: 10%;">
      <div class="btn-group-vertical">
        <button type="button" class="btn btn-success btn-lg" @click="addRoutes"><i class="fas fa-chevron-right"></i></button>
        <button type="button" class="btn btn-danger btn-lg" @click="removeRoutes"><i class="fas fa-chevron-left"></i></button>
      </div>
    </div>

    <div class="col">
      <div class="form-group">
        <input type="text" class="form-control" v-model="searchKey.permission" :placeholder="$t('permission.search-for-assigned')">
        <select multiple class="form-control" size="20" ref="select-assigned">
          <optgroup :label="$t('route.route')">
            <option v-for="route in permissionRouteData" :value="route.method+' '+route.child">{{route.method.toUpperCase()}} {{route.child}}</option>
          </optgroup>
        </select>
      </div>
    </div>
  </div>
  {{permissionRouteItem}}
</div>
</template>

<script>
import api from "../../api";
import { mapState, mapActions } from "vuex";

export default {
  data() {
    return {
      name: this.$route.params.name,
      searchKey: { route: "", permission: "" }
    };
  },
  computed: mapState({
    routeItem: state => state.authItem.permissionItem.route,
    permissionRouteItem: state => state.authItem.permissionRouteItem,
    permissionRouteData() {
      var keyWord = this.searchKey.permission && this.searchKey.permission.toLowerCase();
      var data = this.permissionRouteItem;
      if (!keyWord) {
        return data;
      }

      data = data.filter(row => {
        return (
          String(row.child)
            .toLowerCase()
            .indexOf(keyWord) > -1
        );
      });

      return data;
    },
    routeData() {
      var keyWord = this.searchKey.route && this.searchKey.route.toLowerCase();
      var data = this.routeItem;
      
      if (data) {
        data = data.filter(row => {
          var check = true;
          this.permissionRouteItem.forEach(function(val) {
            if (row.method+row.name == val.method+val.child) {
              check = false;
            }
          });

          return check;
        });
      }

      if (!keyWord) {
        return data;
      }

      data = data.filter(row => {
        return (
          String(row.name)
            .toLowerCase()
            .indexOf(keyWord) > -1
        );
      });

      return data;
    }
  }),
  created() {
    this.getPermission();
    this.getPermissionRoute(this.$route.params.name);
  },
  methods: {
    ...mapActions(["getPermission", "getPermissionRoute"]),
    addRoutes(event) {
      var select_routes = $(this.$refs["select-route"]).val();
      if (select_routes.length == 0) {
        return false;
      }

      var childs = [];
      select_routes.forEach(row =>{
        let tmp = row.split(" ");
        childs.push({method: tmp[0], child: tmp[1]});
      });

      var _this = this;
      var $btn = $(event.currentTarget);
      $btn.loading('<i class="fas fa-spinner fa-spin"></i>');
      api.setPermissionRoute({
        parent: _this.$route.params.name,
        childs: childs
      }).then(function(res) {
        if (res.body.status) {
          select_routes.forEach(row => {
            let tmp = row.split(" ");
            _this.permissionRouteItem.push({
              parent: _this.$route.params.name,
              method: tmp[0],
              child: tmp[1]
            });
          });
        } else {
          alert(res.body.msg);
        }
        $btn.loading("reset");
      });
    },
    removeRoutes(event) {
      var select_assigned = $(this.$refs["select-assigned"]).val();
      if (select_assigned.length == 0) {
        return false;
      }

      var childs = [];
      select_assigned.forEach(row =>{
        let tmp = row.split(" ");
        childs.push({method: tmp[0], child: tmp[1]});
      });

      var _this = this;
      var $btn = $(event.currentTarget);
      $btn.loading('<i class="fas fa-spinner fa-spin"></i>');
      api.deletePermissionRoute({
        parent: _this.$route.params.name,
        childs: childs
      }).then(function(res) {
        if (res.body.status) {
          for (let i = _this.permissionRouteItem.length-1; i >= 0; i--) {
            if (select_assigned.indexOf(_this.permissionRouteItem[i]['method'] + ' ' + _this.permissionRouteItem[i]['child']) > -1) {
              _this.permissionRouteItem.splice(i, 1);
            }
          }
        } else {
          alert(res.body.msg);
        }
        $btn.loading("reset");
      });
    }
  }
};
</script>
