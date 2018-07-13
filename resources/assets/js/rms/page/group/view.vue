<template>
<div class="view">
  <div class="col-12">
    <div class="row justify-content-between">
      <div class="col-8 h3">{{ $t("group.group") }}: {{groupInfo.name}}</div>

      <div class="col-4 text-right">
        <router-link :to="{path: '/group'}" class="btn col-4 btn-light">
          <i class="fa fa-arrow-left"></i> {{$t('common.back')}}
        </router-link>
      </div>
    </div>
  </div>

  <div class="col-12">
    <div class="card">
      <h5 class="card-header text-muted"><i class="fas fa-users"></i> {{$t('group.users-to-group')}}</h5>
      <div class="card-body">

        <div class="row">
          <div class="col">
            <div class="form-group">
              <input type="text" class="form-control" v-model="userToGroupKey.user" :placeholder="$t('group.search-for-user')">
              <select multiple class="form-control" size="20" ref="select-user">
                <optgroup :label="$t('group.user')">
                  <option v-for="(item,inx) in userItemData" :value="item.id">{{item.name}} ({{item.email}})</option>
                </optgroup>
              </select>
            </div>
          </div>

          <div class="col-2 text-center" style="margin-top: 10%;">
            <div class="btn-group-vertical">
              <button type="button" class="btn btn-success btn-lg" @click="addUserChild"><i class="fas fa-chevron-right"></i></button>
              <button type="button" class="btn btn-danger btn-lg" @click="removeUserChild"><i class="fas fa-chevron-left"></i></button>
            </div>
          </div>

          <div class="col">
            <div class="form-group">
              <input type="text" class="form-control" v-model="userToGroupKey.group" :placeholder="$t('group.search-for-user')">
              <select multiple class="form-control" size="20" ref="select-user-group">
                <optgroup :label="$t('group.user')">
                  <option v-for="(item,inx) in userChildItemData" :value="item.id">{{item.name}} ({{item.email}})</option>
                </optgroup>
              </select>
            </div>
          </div>
        </div>
        
      </div>
    </div>
    <br><br>

    <div class="card">
      <h5 class="card-header text-muted"><i class="fas fa-user"></i> {{$t('group.permissions-roles-to-group')}}</h5>
      <div class="card-body">
        
        <div class="row">
          <div class="col">
            <div class="form-group">
              <input type="text" class="form-control" v-model="roleTogroupKey.item" :placeholder="$t('group.search-for-user')">
              <select multiple class="form-control" size="20" ref="select-item-child">
                <optgroup :label="$t('group.role')">
                  <option v-for="(item,inx) in roleItemData">{{item.name}}</option>
                </optgroup>

                <optgroup :label="$t('group.permission')">
                  <option v-for="(item,inx) in itemPermissionData">{{item.name}}</option>
                </optgroup>
              </select>
            </div>
          </div>

          <div class="col-2 text-center" style="margin-top: 10%;">
            <div class="btn-group-vertical">
              <button type="button" class="btn btn-success btn-lg" @click="addItemChild"><i class="fas fa-chevron-right"></i></button>
              <button type="button" class="btn btn-danger btn-lg" @click="removeItemChild"><i class="fas fa-chevron-left"></i></button>
            </div>
          </div>

          <div class="col">
            <div class="form-group">
              <input type="text" class="form-control" v-model="roleTogroupKey.group" :placeholder="$t('group.search-for-user')">
              <select multiple class="form-control" size="20" ref="select-item-child-group">
                <optgroup :label="$t('group.role')">
                  <option v-for="(item,inx) in itemChildItemData.role">{{item.name}}</option>
                </optgroup>

                <optgroup :label="$t('group.permission')">
                  <option v-for="(item,inx) in itemChildItemData.permission">{{item.name}}</option>
                </optgroup>
              </select>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>

</div>
</template>

<script>
import api from "../../api";
import { mapState, mapActions } from "vuex";

export default {
  data() {
    return {
      groupInfo: {id: this.$route.params.id, name: this.$route.params.name},
      userToGroupKey: {user: '', group: ''},
      roleTogroupKey: {item: '', group: ''},
    };
  },
  computed: mapState({
    userItem: state => state.authGroup.userItem,
    userChildItem: state => state.authGroup.userChildItem,
    itemChildItem: state => state.authGroup.itemChildItem,
    itemPermission: state => state.authItem.permissionItem.permission,
    roleItem: state => state.authItem.roleItem,
    userItemData() {
      var keyWord = this.userToGroupKey.user && this.userToGroupKey.user.toLowerCase();
      var data = [];
      data = this.userItem.filter(user =>{
        var isExist = true;
        this.userChildItem.forEach(child =>{
          if (user.id == child.child) {
            isExist = false;
          }
        });

        return isExist;
      });

      if (!keyWord) {
        return data;
      }

      data = data.filter(row => {
        return (
          String(row.name).toLowerCase().indexOf(keyWord) > -1
          || String(row.email).toLowerCase().indexOf(keyWord) > -1
        );
      });

      return data;
    },
    userChildItemData() {
      var keyWord = this.userToGroupKey.group && this.userToGroupKey.group.toLowerCase();

      if (!this.userChildItem.length > 1) {
        return [];
      }

      var data = [];
      this.userItem.forEach(user =>{
        this.userChildItem.forEach(child =>{
          if (user.id == child.child) {
            data.push(user);
          }
        });
      });

      if (!keyWord) {
        return data;
      }

      data = data.filter(row => {
        return (
          String(row.name).toLowerCase().indexOf(keyWord) > -1
          || String(row.email).toLowerCase().indexOf(keyWord) > -1
        );
      });

      return data;
    },
    itemPermissionData() {
      var keyWord = this.roleTogroupKey.item && this.roleTogroupKey.item.toLowerCase();
      if (!this.itemPermission) {
        return [];
      }

      var data = [];
      var _this = this;
      data = this.itemPermission.filter(row =>{
        var isExist = true;
        _this.itemChildItem.forEach(item =>{
          if (item.child == row.name) {
            isExist = false;
          }
        });

        return isExist;
      });
    
      if (!keyWord) {
        return data;
      }

      data = data.filter(row =>{
        return String(row.name).toLowerCase().indexOf(keyWord) > -1;
      });

      return data;
    },
    roleItemData() {
      var keyWord = this.roleTogroupKey.item && this.roleTogroupKey.item.toLowerCase();
      if (!this.roleItem) {
        return [];
      }

      var data = [];
      var _this = this;
      data = this.roleItem.filter(row =>{
        var isExist = true;
        _this.itemChildItem.forEach(item =>{
          if (item.child == row.name) {
            isExist = false;
          }
        });

        return isExist;
      });

      if (!keyWord) {
        return data;
      }

      data = data.filter(row =>{
        return String(row.name).toLowerCase().indexOf(keyWord) > -1;
      });

      return data;
    },
    itemChildItemData() {
      var keyWord = this.roleTogroupKey.group && this.roleTogroupKey.group.toLowerCase();
      var role = [];
      var permission = [];
      var data = {'role': role, 'permission': permission};
      var _this = this;

      if (!_this.itemPermission || !_this.roleItem) {
        return [];
      }

      _this.itemPermission.forEach(row =>{
        _this.itemChildItem.forEach(item =>{
          if (item.child == row.name) {
            data.permission.push(row);
          }
        });
      });
      
      _this.roleItem.forEach(row =>{
        _this.itemChildItem.forEach(item =>{
          if (item.child == row.name) {
            data.role.push(row);
          }
        });
      });

      if (!keyWord) {
        return data;
      }

      var newData = {'role': [], 'permission': []};
      newData.permission = data.permission.filter(row =>{
        return String(row.name).toLowerCase().indexOf(keyWord) > -1;
      });

      newData.role = data.role.filter(row =>{
        return String(row.name).toLowerCase().indexOf(keyWord) > -1;
      });
      
      return newData;
    },
  }),
  created() {
    this.getUser();
    this.getUserChildItem(this.$route.params.id);
    this.getItemChildItem(this.$route.params.id);
    this.getPermission();
    this.getRole();
  },
  methods: {
    ...mapActions(["getUser", "getUserChildItem", "getItemChildItem", "getPermission", "getRole"]),
    addUserChild(event) {
      var select_users = $(this.$refs["select-user"]).val();
      if (select_users.length == 0) {
        return false;
      }

      var _this = this;
      var $btn = $(event.currentTarget);
      $btn.loading('<i class="fas fa-spinner fa-spin"></i>');

      api.setGroupChild({
        group_id: _this.$route.params.id,
        type: 1,
        childs: select_users
      }).then(function (res) {
        if (res.body.status) {
          select_users.forEach(userId => {
            _this.userChildItem.push({
              group_id: _this.$route.params.id,
              child: userId,
              type: 1
            });
          });
        } else {
          alert(res.body.msg);
        }

        $btn.loading('reset');
      });
    },
    removeUserChild(event) {
      var select_user_group = $(this.$refs["select-user-group"]).val();
      if (select_user_group.length == 0) {
        return false;
      }

      var _this = this;
      var $btn = $(event.currentTarget);
      $btn.loading('<i class="fas fa-spinner fa-spin"></i>');

      api.removeGroupChild({
        group_id: _this.$route.params.id,
        type: 1,
        childs: select_user_group
      }).then(function(res) {
        if (res.body.status) {
          for (let i = _this.userChildItem.length-1; i >= 0; i--) {
            if (select_user_group.indexOf(_this.userChildItem[i]['child']) > -1) {
              _this.userChildItem.splice(i, 1);
            }
          }
        } else {
          alert(res.body.msg);
        }

        $btn.loading('reset');
      });
    },
    addItemChild(event) {
      var select_item = $(this.$refs["select-item-child"]).val();
      if (select_item.length == 0) {
        return false;
      }

      var _this = this;
      var $btn = $(event.currentTarget);
      $btn.loading('<i class="fas fa-spinner fa-spin"></i>');

      api.setGroupChild({
        group_id: _this.$route.params.id,
        type: 2,
        childs: select_item,
      }).then(res =>{
        if (res.body.status) {
          select_item.forEach(row =>{
            _this.itemChildItem.push({group: _this.$route.params.id, child: row, type: 2});
          });
        } else {
          alert(res.body.status);
        }
        $btn.loading('reset');
      });
    },
    removeItemChild(event) {
      var select_item_group = $(this.$refs["select-item-child-group"]).val();
      if (select_item_group.length == 0) {
        return false;
      }

      var _this = this;
      var $btn = $(event.currentTarget);
      $btn.loading('<i class="fas fa-spinner fa-spin"></i>');

      api.removeGroupChild({
        group_id: _this.$route.params.id,
        type: 2,
        childs: select_item_group,
      }).then(res =>{
        if (res.body.status) {
          for (let i = _this.itemChildItem.length-1; i >= 0; i--) {
            if (select_item_group.indexOf(_this.itemChildItem[i]['child']) > -1) {
              _this.itemChildItem.splice(i, 1);
            }
          }
        } else {
          alert(res.body.status);
        }
        $btn.loading('reset');
      });
    },
  }
};
</script>

