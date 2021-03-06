@extends('web.layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card bg-light">
        {{-- <div class="card-header">{{ __('Register') }}</div> --}}
        <div class="card-header">
          <div class="row justify-content-between">
            <div class="col-8 h5">Create An Account</div>

            <div class="col-4 text-right">
              <a class="btn-link text-info" href="{{ route('login') }}"><i class="fas fa-sign-in-alt"></i> <b>LOG IN?</b></a>
            </div>
          </div>
        </div>

        <div class="card-body">
          <form method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}">
            @csrf

            <div class="form-group row">
              <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

              <div class="col-md-6">
                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                @if ($errors->has('name'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('name') }}</strong>
                  </span>
                @endif
              </div>
            </div>

            <div class="form-group row">
              <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

              <div class="col-md-6">
                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                @if ($errors->has('email'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('email') }}</strong>
                  </span>
                @endif
              </div>
            </div>

            <div class="form-group row">
              <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

              <div class="col-md-6">
                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                @if ($errors->has('password'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('password') }}</strong>
                  </span>
                @endif
              </div>
            </div>

            <div class="form-group row">
              <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

              <div class="col-md-6">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
              </div>
            </div>

            <div class="form-group row">
              <label for="verification_code" class="col-md-4 col-form-label text-md-right">Verification Code</label>
              <div class="col-md-6">
                <div class="input-group mb-3">
                  <input type="text" class="form-control {{ $errors->has('captcha') ? ' is-invalid' : '' }}">
                  <div class="input-group-append">
                    <span class="input-group-text"><img src="{{captcha_src()}}" class="img-fluid"></span>
                  </div>
                  @if ($errors->has('captcha'))
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('captcha') }}</strong>
                    </span>
                  @endif
                </div>
              </div>
            </div>
            

            <div class="form-group row mb-0">
              <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                  {{ __('Register') }}
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
