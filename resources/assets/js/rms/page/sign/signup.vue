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
            <input type="text" class="form-control" :placeholder="$t('sign.username')">
          </div>
        </div>

        <div class="form-group row">
          <label class="col-sm-3 col-form-label text-right">{{$t('sign.e-mail-address')}}</label>
          <div class="col-sm-8">
            <input type="email" class="form-control" :placeholder="$t('sign.e-mail-address')">
          </div>
        </div>

        <div class="form-group row">
          <label class="col-sm-3 col-form-label text-right">{{$t('sign.username')}}</label>
          <div class="col-sm-8">
            <input type="password" class="form-control" :placeholder="$t('sign.username')">
          </div>
        </div>

        <div class="form-group row">
          <label class="col-sm-3 col-form-label text-right">{{$t('sign.confrim-password')}}</label>
          <div class="col-sm-8">
            <input type="password" class="form-control" :placeholder="$t('sign.confrim-password')">
          </div>
        </div>

        <div class="form-group row">
          <div class="col-sm-8 offset-sm-3">
            <div class="checkbox">
              <label><input type="checkbox" name="remember"> {{$t('sign["by-creating-an-account-you-agree-with-our-terms-of-service"]')}}</label>
            </div>
          </div>
        </div>

        <div class="form-group row">
          <div class="col-sm-8 offset-sm-3">
            <button type="submit" class="btn btn-success btn-lg"><i class="fas fa-user-plus"></i> {{$t('sign.create-account')}}</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
</template>
