@extends('web.layouts.rms')

@section('title')
RMS
@endsection

@section('content')
<transition name="slide-fade">
  <router-view></router-view>
</transition>
@endsection
