<template>
<div class="col-10">
  <div class="card bg-light">
    <div class="card-header bg-dark text-white">
      <div class="row justify-content-between">
        <div class="col-8 h4">{{ $t("sign.log-in-to-your-account") }}</div>

        <div class="col-4 text-right">
          <router-link class="btn-link text-info" :to="{path: 'up'}"><b>{{ $t("sign.sign-in") }}?</b></router-link>
        </div>
      </div>
    </div>
    
    <div class="card-body">
      <form>
        <div class="form-group row">
          <label class="col-sm-3 col-form-label text-right">{{ $t("sign.e-mail-address") }}</label>
          <div class="col-sm-8">
            <input type="email"
              class="form-control"
              :class="{'is-invalid':validate && (loginModel.email=='')}"
              v-model="loginModel.email"
              :placeholder="$t('sign.e-mail-address')">
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-3 col-form-label text-right">{{ $t("sign.password") }}</label>
          <div class="col-sm-8">
            <input type="password"
            class="form-control"
            :class="{'is-invalid':validate && (loginModel.password=='')}"
            v-model="loginModel.password"
            @keyup.enter="login"
            :placeholder="$t('sign.password')">
          </div>
        </div>
        <div class="form-group row">
          <div class="col-sm-8 offset-sm-3">
            <div class="form-group">
              <div class="form-check">
                <input class="form-check-input"
                  type="checkbox"
                  v-model="loginModel.remember"
                  id="remember"
                  required>
                <label class="form-check-label" for="remember">
                  {{ $t("sign.remember-me") }}
                </label>
              </div>
            </div>
          </div>
        </div>

        <div class="form-group row">
          <div class="col-sm-8 offset-sm-3">
            <button type="button" class="btn btn-lg btn-primary" @click="login" ref="login">{{ $t("sign.sign-in") }}</button>
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
      loginModel: {
        email: '',
        password: '',
        remember: false,
      },
      validate: false,
    };
  },
  methods: {
    login(event) {
      this.validate = true;
      if (this.loginModel.email == ''
      || this.loginModel.password == '') {
        return false;
      }
      
      var _this = this;
      var $btn = $(this.$refs.login);
      $btn.loading('<i class="fas fa-spinner fa-spin"></i>');
      api.login(this.loginModel).then(res =>{
        if (res.body.status) {
          if (_this.loginModel.remember) {
            $.setCookie('user-info', JSON.stringify(res.body.data, 3 * 24 * 60));
          } else {
            $.setCookie('user-info', JSON.stringify(res.body.data));
          }

          _this.$router.push({ path: "/select" });
        } else {
          alert(res.body.msg);
          $btn.loading('reset');
        }
      });
    },
  }
};
</script>
