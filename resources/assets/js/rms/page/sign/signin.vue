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
            <input type="email" class="form-control" :placeholder="$t('sign.e-mail-address')">
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-3 col-form-label text-right">{{ $t("sign.password") }}</label>
          <div class="col-sm-8">
            <input type="password" class="form-control" :placeholder="$t('sign.password')">
          </div>
        </div>
        <div class="form-group row">
          <div class="col-sm-8 offset-sm-3">
            <div class="checkbox">
              <label><input type="checkbox" name="remember"> {{ $t("sign.remember-me") }}</label>
            </div>
          </div>
        </div>

        <div class="form-group row">
          <div class="col-sm-8 offset-sm-3">
            <button type="submit" class="btn btn-lg btn-primary">{{ $t("sign.sign-in") }}</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
</template>

<script>
export default {
  created() {
    console.log('11');
  }
};
</script>
