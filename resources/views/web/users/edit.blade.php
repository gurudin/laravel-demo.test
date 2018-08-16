@extends('web.layouts.app')

@section('title', $user->name . ' 的个人中心')

@section('content')
<div class="row justify-content-center">
  <div class="col-8">
    <div class="card">
      <div class="card-header h5">
        编辑个人资料
      </div>
      <div class="card-body">
        
        <form method="POST" action="{{ route('users.update', Auth::id()) }}" accept-charset="UTF-8" enctype="multipart/form-data">
          @csrf
          @method('PUT')

          <div class="form-group row">
            <label class="col-sm-3 col-form-label text-right">用户名</label>
            <div class="col-sm-8">
              <input type="text" name="name" value="{{old('name', $user->name)}}" placeholder="用户名" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}">

              @if ($errors->has('name'))
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('name') }}</strong>
                </span>
              @endif
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-3 col-form-label text-right">邮箱地址</label>
            <div class="col-sm-8">
              <input type="email" name="email" value="{{old('email', $user->email)}}" placeholder="邮箱地址" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}">

              @if ($errors->has('name'))
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('name') }}</strong>
                </span>
              @endif
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-3 col-form-label text-right">头像</label>
            <div class="col-sm-8">
              <input type="file" class="form-control{{ $errors->has('avatar') ? ' is-invalid' : '' }}" name="avatar">
              @if ($errors->has('avatar'))
                <span class="invalid-feedback">
                  <strong>{{ $errors->first('avatar') }}</strong>
                </span>
              @endif

              @if ($user->avatar)
                <br>
                <img class="img-thumbnail" src="{{ $user->avatar }}" alt="个人头像">
              @endif
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-3 col-form-label text-right">个人简介</label>
            <div class="col-sm-8">
              <textarea name="introduction" class="form-control {{ $errors->has('introduction') ? 'is-invalid' : '' }}" rows="3">{{old('introduction', $user->introduction)}}</textarea>

              @if ($errors->has('introduction'))
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('introduction') }}</strong>
                </span>
              @endif
            </div>
          </div>

          <div class="form-group row">
            <div class="col-sm-8 offset-sm-3">
              <button type="submit" class="btn btn-lg btn-success"><i class="fas fa-edit"></i> 修改</button>
            </div>
          </div>
        </form>

      </div>
    </div>
  </div>
</div>
@endsection 