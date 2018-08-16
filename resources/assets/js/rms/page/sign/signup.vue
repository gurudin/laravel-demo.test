<template>
<div class="col-10">
  <div class="card bg-light">
    <div class="card-header bg-dark text-white">
      <div class="row justify-content-between">
        <div class="col-8 h4">{{$t('sign.create-account')}}</div>

        <div class="col-4 text-right">
          <router-link class="btn-link text-info" :to="{path: 'in'}"><i class="fas fa-sign-in-alt"></i> <b>{{$t('sign.sign-in')}}?</b></router-link>
        </div>
      </div>
    </div>
    
    <div class="card-body">
      <form>
        <div class="form-group row">
          <label class="col-sm-3 col-form-label text-right">{{$t('sign.username')}}</label>
          <div class="col-sm-8">
            <input type="text"
              class="form-control"
              :class="{'is-invalid':validate && (userModel.name=='' || errModel.name)}"
              v-model="userModel.name"
              :placeholder="$t('sign.username')">
              <div class="invalid-feedback" v-if="errModel.name">
                {{errModel.name[0]}}
              </div>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-sm-3 col-form-label text-right">{{$t('sign.e-mail-address')}}</label>
          <div class="col-sm-8">
            <input type="email"
              class="form-control"
              :class="{'is-invalid':validate && (userModel.email=='' || errModel.email)}"
              v-model="userModel.email"
              :placeholder="$t('sign.e-mail-address')">
              <div class="invalid-feedback" v-if="errModel.email">
                {{errModel.email[0]}}
              </div>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-sm-3 col-form-label text-right">{{$t('sign.password')}}</label>
          <div class="col-sm-8">
            <input type="password"
              class="form-control"
              :class="{'is-invalid':validate && (userModel.password=='' || errModel.password)}"
              v-model="userModel.password"
              :placeholder="$t('sign.password')">
              <div class="invalid-feedback" v-if="errModel.password">
                {{errModel.password[0]}}
              </div>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-sm-3 col-form-label text-right">{{$t('sign.confrim-password')}}</label>
          <div class="col-sm-8">
            <input type="password"
              class="form-control"
              :class="{'is-invalid':validate && (userModel.c_password=='' || userModel.password != userModel.c_password)}"
              v-model="userModel.c_password"
              :placeholder="$t('sign.confrim-password')">
            <div class="invalid-feedback" v-if="userModel.password != userModel.c_password">
              {{$t('sign.inconsistent-password')}}
            </div>
          </div>
        </div>

        <div class="form-group row">
          <div class="col-sm-8 offset-sm-3">
            <div class="form-group">
              <div class="form-check">
                <input class="form-check-input"
                  :class="{'is-invalid':validate && !userModel.agree}"
                  type="checkbox"
                  v-model="userModel.agree"
                  id="agree"
                  required>
                <label class="form-check-label" for="agree">
                  {{$t('sign["by-creating-an-account-you-agree-with-our-terms-of-service"]')}}
                </label>
              </div>
            </div>
          </div>
        </div>

        <div class="form-group row">
          <div class="col-sm-8 offset-sm-3">
            <button type="button" class="btn btn-success btn-lg" @click="save"><i class="fas fa-user-plus"></i> {{$t('sign.create-account')}}</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
</template>

<script>
import api from '../../api';

export default {
  data() {
    return {
      userModel: {
        name: '',
        email: '',
        password: '',
        c_password: '',
        agree: false,
      },
      errModel: {},
      validate: false,
    };
  },
  methods: {
    save(event) {
      this.validate = true;
      if (this.userModel.name == ''
      || this.userModel.email == ''
      || this.userModel.password == ''
      || this.userModel.c_password == ''
      || this.agree == false
      || (this.userModel.password != this.userModel.c_password)) {
        return false;
      }

      var _this = this;
      var $btn = $(event.currentTarget);
      $btn.loading('<i class="fas fa-spinner fa-spin"></i>');
      api.register(this.userModel).then(res =>{
        if (res.body.status) {
          _this.$router.push({ path: "/in" });
        } else {
          _this.errModel = res.body.data;
          $btn.loading('reset');
        }
      });
      
    }
  },
};
</script>
