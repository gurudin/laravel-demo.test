@extends('web.layouts.blank')

@section('title')
Sign
@endsection

@section('css')
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <style>
  body {
    background: #f2f2f2;
  }
  </style>
@endsection

@section('script')
  <script src="{{ asset('js/sign.js') }}" defer></script>
@endsection

@section('content')
  <div id="app">
    <main style="margin-top: 10%;">
      <div class="container">
        <div class="row justify-content-md-center">
          <router-view></router-view>
        </div>
      </div>
    </main>
  </div>
@endsection