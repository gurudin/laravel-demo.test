@extends('web.layouts.app')

@section('title', $user->name . ' 的个人中心')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-lg col-lg-3 col-md-3">
        <div class="card">
          <div class="card-body">
            <img class="card-img-top img-thumbnail"
                src="{{$user->avatar ?: 'http://pbuht5kwp.bkt.clouddn.com/avatar.png'}}"
                width="300px" height="300px">
            <hr>
            <h5 class="card-title">个人简介</h5>
            <p class="card-text">{{$user->introduction ?: '无'}}</p>
            <hr>
            <h5><strong>注册于</strong></h5>
          <p>{{$user->created_at}}</p>
          </div>
        </div>
      </div>
      <div class="col-lg col-lg-9 col-md-9 col-sm-12">
        <div class="card">
          <div class="card-body">
            Email
            <small>{{$user->email}}</small>
          </div>
        </div>

        <p></p>

        <div class="card mx-auto">
          <div class="card-body">

            <ul class="nav nav-tabs" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#topic">Ta 的话题</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#conmmit">Ta 的回复</a>
              </li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane fade show active" id="topic" role="tabpanel" aria-labelledby="home-tab">
                topic
              </div>
              <div class="tab-pane fade" id="conmmit" role="tabpanel" aria-labelledby="profile-tab">
                conmmit
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
