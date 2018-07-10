<template>
<div class="view">
  <div class="col-12">
    <div class="row justify-content-between">
      <div class="col-4 h3">{{ $t("permission.create-permission") }}</div>

      <div class="col-4 text-right">
        <router-link :to="{path: '/permission'}" class="btn col-4 btn-light">
          <i class="fa fa-arrow-left"></i> {{$t('common.back')}}
        </router-link>
      </div>
    </div>
  </div>

  <div class="col-12">
    <form>
      <div class="form-group">
        <label>{{$t('permission.name')}}</label>
        <input
          type="text"
          class="form-control"
          maxlength="50"
          v-model="modelData.name"
          :class="{'is-invalid': validate && modelData.name==''}"
          :placeholder="$t('permission.name')">
      </div>

      <div class="form-group">
        <label>{{$t('permission.description')}}</label>
        <input
          type="text"
          class="form-control"
          maxlength="50"
          v-model="modelData.description"
          :class="{'is-invalid': validate && modelData.description==''}"
          :placeholder="$t('permission.description')">
      </div>

      <button type="button" class="btn btn-success" @click="save">{{$t('common.save')}}</button>
    </form>
  </div>
</div>
</template>

<script>
import api from "../../api";

export default {
  data() {
    return {
      modelData: {
        name: "",
        method: '',
        type: 2,
        description: ""
      },
      validate: false
    };
  },
  methods: {
    save(event) {
      this.validate = true;
      if (this.modelData.name == "" || this.modelData.description == "") {
        return false;
      }

      var _this = this;
      var $btn = $(event.target);
      $btn.loading();
      api.setAuthItem(this.modelData).then(function(res) {
        if (res.body.status) {
          _this.$router.push({ path: "/permission" });
        } else {
          alert(res.body.msg);
        }
        $btn.loading("reset");
      });
    }
  }
};
</script>
