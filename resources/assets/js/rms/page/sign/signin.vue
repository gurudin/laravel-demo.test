<template>
<div class="col-10">
  <div class="card bg-light">
    <div class="card-header bg-dark text-white">
      <div class="row justify-content-between">
        <div class="col-8 h4">Log In to Your Account</div>

        <div class="col-4 text-right">
          <router-link class="btn-link text-info" :to="{path: 'up'}"><b>SIGN UP?</b></router-link>
        </div>
      </div>
    </div>
    
    <div class="card-body">
      <form>
        <div class="form-group row">
          <label class="col-sm-3 col-form-label text-right">E-Mail Address</label>
          <div class="col-sm-8">
            <input type="email" class="form-control" placeholder="E-Mail Address">
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-3 col-form-label text-right">Password</label>
          <div class="col-sm-8">
            <input type="password" class="form-control" placeholder="Password">
          </div>
        </div>
        <div class="form-group row">
          <div class="col-sm-8 offset-sm-3">
            <div class="checkbox">
              <label><input type="checkbox" name="remember"> Remember Me</label>
            </div>
          </div>
        </div>

        <div class="form-group row">
          <div class="col-sm-8 offset-sm-3">
            <button type="submit" class="btn btn-primary">Sign in</button>
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
