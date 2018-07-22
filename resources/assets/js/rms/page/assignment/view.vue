<template>
<div class="view">
  <div class="col-12">
    <div class="row justify-content-between">
      <div class="col-8 h3">{{ $t("assignment.assignment") }} : {{ userDetail.name }}</div>

      <div class="col-4 text-right">
        <router-link :to="{path: '/assignment'}" class="btn col-4 btn-light">
          <i class="fa fa-arrow-left"></i> {{$t('common.back')}}
        </router-link>
      </div>
    </div>
  </div>

  <div class="row col-12">
    <div class="input-group mb-3 col-12">
      <div class="input-group-prepend">
        <label class="input-group-text">{{ $t('assignment.select-group') }}</label>
      </div>
      <select class="custom-select" v-model="defaultGroup">
        <option v-for="item in userDetail.group" :value="item.group_id">{{item.name}}</option>
      </select>
    </div>

    <div class="col-12"><br></div>

    <div class="col">
      <div class="form-group">
        <input type="text" class="form-control" v-model="searchKey.distributor" :placeholder="$t('assignment.search-for-permission')">
        <select multiple class="form-control" size="20" ref="select-distributor">
          <optgroup :label="$t('assignment.permission')">
            <option v-for="item in distributorData">{{item}}</option>
          </optgroup>
        </select>
      </div>
    </div>

    <div class="col-2 text-center" style="margin-top: 10%;">
      <div class="btn-group-vertical">
        <button type="button" class="btn btn-success btn-lg" @click="addAssignment"><i class="fas fa-chevron-right"></i></button>
        <button type="button" class="btn btn-danger btn-lg" @click="removeAssignment"><i class="fas fa-chevron-left"></i></button>
      </div>
    </div>

    <div class="col">
      <div class="form-group">
        <input type="text" class="form-control" v-model="searchKey.assignee" :placeholder="$t('assignment.search-for-permission')">
        <select multiple class="form-control" size="20" ref="select-assignee">
          <optgroup :label="$t('assignment.permission')">
            <option v-for="item in permissionData">{{item}}</option>
          </optgroup>
        </select>
      </div>
    </div>
  </div>

</div>

</template>

<script>
export default {
  data() {
    return {
      userId: this.$route.params.id,
      groupId: this.$route.query.group,
      userDetail: {},
      distributorDetail: {},
      searchKey: {distributor: '', assignee: ''},
      defaultGroup: 0,
    };
  },
  computed: {
    distributorData() {
      var keyWord = this.searchKey.distributor && this.searchKey.distributor.toLowerCase();
      var _this = this;
      var data = [];
      var permission = [];

      if (JSON.stringify(this.distributorDetail) == '{}') {
        return [];
      }

      this.distributorDetail.forEach(row => {
        if (row.id == _this.defaultGroup) {
          data = row;
        }
      });
    
      permission = data.child.filter(row =>{
        var isChk = true;
        for (let i = _this.permissionData.length - 1; i >= 0; i--) {
          if (_this.permissionData[i] == row){
            isChk = false;
          }
        }
        
        return isChk && String(row).toLowerCase().indexOf(keyWord) > -1;
      });
      
      return permission;
    },
    permissionData() {
      var keyWord = this.searchKey.assignee && this.searchKey.assignee.toLowerCase();
      var _this = this;
      var data = [];
      var permission = [];

      if (JSON.stringify(this.userDetail) == '{}') {
        return [];
      }

      this.userDetail.group.forEach(row => {
        if (row.group_id == _this.defaultGroup) {
          data = row;
        }
      });

      permission = data.permission.filter(row =>{
        return String(row).toLowerCase().indexOf(keyWord) > -1;
      });

      return permission;
    },
  },
  methods: {
    getDistributor(groups) {
      var groupArr = [];
      var _this = this;
      groups.forEach(row =>{
        groupArr.push(row.group_id);
      });

      let groupIds = groupArr.join();
      this.GLOBAL.api.getAuthGroupPermission(groupIds).then(res =>{
        _this.distributorDetail = res.body.data;
      });
    },
    addAssignment(event) {
      var selectAssign = $(this.$refs['select-distributor']).val();
      var _this = this;

      if (selectAssign.length == 0) {
        return false;
      }

      var $btn = $(event.currentTarget);
      $btn.loading('<i class="fas fa-spinner fa-spin"></i>');

      this.GLOBAL.api.setAuthAssignment({
        user_id: this.userId,
        group_id: this.defaultGroup,
        items: selectAssign
      }).then(res =>{
        if (res.body.status) {
          _this.userDetail.group.forEach((row, inx) =>{
            if (row.group_id == _this.defaultGroup) {
              selectAssign.forEach(item =>{
                row.permission.push(item);
              });
            }
          });
        } else {
          alert(res.body.msg);
        }
        $btn.loading('reset');
      });
    },
    removeAssignment(event) {
      var removeAssign = $(this.$refs['select-assignee']).val();
      var _this = this;

      if (removeAssign.length == 0) {
        return false;
      }

      var $btn = $(event.currentTarget);
      $btn.loading('<i class="fas fa-spinner fa-spin"></i>');

      this.GLOBAL.api.removeAuthAssignment({
        user_id: this.userId,
        group_id: this.defaultGroup,
        items: removeAssign
      }).then(res =>{
        if (res.body.status) {
          _this.userDetail.group.forEach((row, inx) =>{
            if (row.group_id == _this.defaultGroup) {
              for (let i = row.permission.length; i >= 0; i--) {
                if (removeAssign.indexOf(row.permission[i]) > -1) {
                  row.permission.splice(i, 1);
                }
              }
            }
          });
        } else {
          alert(res.body.msg);
        }
        $btn.loading('reset');
      });
    }
  },
  created() {
    var _this = this;
    this.GLOBAL.api.getAuthUserDetail(this.userId, this.groupId).then(res => {
      _this.userDetail = res.body.data;
      _this.defaultGroup = res.body.data.group[0].group_id;
      _this.getDistributor(res.body.data.group);
    });
  }
};
</script>
