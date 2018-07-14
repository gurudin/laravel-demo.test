<template>
<div class="col-10">
  <div class="card bg-light">
    <div class="card-header bg-dark text-white">
      <div class="row justify-content-between">
        <div class="col-8 h4">Create An Account</div>

        <div class="col-4 text-right">
          <router-link class="btn-link text-info" :to="{path: 'in'}"><i class="fas fa-sign-in-alt"></i> <b>LOG IN?</b></router-link>
        </div>
      </div>
    </div>
    
    <div class="card-body">
      <form>
        <div class="form-group row">
          <label class="col-sm-3 col-form-label text-right">Username</label>
          <div class="col-sm-8">
            <input type="text" class="form-control" placeholder="Username">
          </div>
        </div>

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
          <label class="col-sm-3 col-form-label text-right">Confrim Password</label>
          <div class="col-sm-8">
            <input type="password" class="form-control" placeholder="Confrim Password">
          </div>
        </div>

        <div class="form-group row">
          <div class="col-sm-8 offset-sm-3">
            <div class="checkbox">
              <label><input type="checkbox" name="remember"> By creating an account, you agree with our Terms of Service.</label>
            </div>
          </div>
        </div>

        <div class="form-group row">
          <div class="col-sm-8 offset-sm-3">
            <button type="submit" class="btn btn-success btn-lg"><i class="fas fa-user-plus"></i> Create Account</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
</template>
