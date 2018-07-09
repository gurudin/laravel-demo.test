<template>
<div class="view">
  <div class="col-12">
    <div class="row justify-content-between">
      <div class="col-4 h3">{{ $t("route.route") }}</div>

      <div class="col-4 text-right"></div>
    </div>
  </div>

  <div class="col-12">
    <div class="card h-100">
      <div class="card-body">
        
        <div class="input-group mb-3">
          <div class="input-group-append">
            <select class="form-control" v-model="routeModel.method">
              <option value="get">GET</option>
              <option value="post">POST</option>
              <option value="put">PUT</option>
              <option value="delete">DELETE</option>
              <option value="any">ANY</option>
            </select>
          </div>
          <input type="text" class="form-control" :class="{'is-invalid':validate && (routeModel.name=='' || routeModel.name[0] != '/')}" v-model.trim="routeModel.name" :placeholder="$t('route.input-routing-address')">
          <div class="input-group-append">
            <button
              class="btn btn-outline-success"
              type="button"
              @click="addRoute">{{$t('route.add-route')}}</button>
          </div>
        </div>

        <div class="list-group" style="height: 600px; overflow: scroll;">

           <li class="list-group-item list-group-item-action" v-for="(item,inx) in permissionItem.route">
            <span class="badge badge-secondary bg-primary">{{item.method.toUpperCase()}}</span> {{item.name}}
            <button type="button" class="btn btn-danger btn-sm float-right" @click="remove($event, inx, item)">
              <i class="fas fa-trash-alt"></i>
            </button>
          </li>

        </div>
      </div>

      <div class="card-footer text-muted">
        Total {{routeLength}}
      </div>
    </div>

  </div>
</div>
</template>

<script>
import api from '../../api';
import { mapState, mapActions } from "vuex";

export default {
  data() {
    return {
      routeModel: {name: '', method: 'get', type: 2},
      validate: false,
    };
  },
  computed: mapState({
    permissionItem: state => state.route.permissionItem,
    routeLength() {
      return this.permissionItem.route ? this.permissionItem.route.length : 0;
    }
  }),
  created() {
    this.getPermission();
  },
  methods: {
    ...mapActions(["getPermission"]),
    addRoute(event) {
      this.validate = true;
      if (this.routeModel.name == '' || this.routeModel.name[0] != '/') {
        return false;
      }
      let isRepet = 1;
      this.permissionItem.route.forEach(row =>{
        if (row.name == this.routeModel.name && row.method == this.routeModel.method) {
          isRepet = 0;
        }
      });

      if (isRepet == 0) {
        alert(this.$t('route.route-repetition'));
        return false;
      }

      var _this = this;
      var $btn = $(event.currentTarget);

      $btn.loading('<i class="fas fa-spinner fa-spin"></i>');
      api.setAuthItem(this.routeModel).then(function (res) {
        if (res.body.status) {
          _this.permissionItem.route.unshift($.extend({}, _this.routeModel));
        } else {
          alert(res.body.msg);
        }
        $btn.loading('reset');
      });
    },
    remove(event, inx, item) {
      if (!confirm(this.$t('common.are-you-sure-to-delete-this-item'))) {
        return false;
      }

      var _this = this;
      var $btn = $(event.currentTarget);
      $btn.loading('<i class="fas fa-spinner fa-spin"></i>');
      api.removeAuthItem({name: item.name, method: item.method}).then(function (res) {
        if (res.body.status) {
          _this.permissionItem.route.splice(inx, 1);
        } else {
          alert(res.body.msg);
        }
        $btn.loading('reset');
      });
    },
  },
};
</script>
