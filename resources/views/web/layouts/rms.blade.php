<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>@yield('title') {{ config('app.name', '') }}</title>

  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}" defer></script>

  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">

  <style>
  .navbar-brand {
    padding-top: .75rem;
    padding-bottom: .75rem;
    font-size: 1rem;
    background-color: rgba(0, 0, 0, .25);
    box-shadow: inset -1px 0 0 rgba(0, 0, 0, .25);
    width: 337px;
  }
  .sidebar {
    position: fixed;
    top: 0;
    bottom: 0;
    left: 0;
    z-index: 100;
    padding: 48px 0 0;
    /* width: 230px; */
    box-shadow: inset -1px 0 0 rgba(0, 0, 0, .1);
  }
  .sidebar-sticky {
    position: -webkit-sticky;
    position: sticky;
  }
  .sidebar-sticky {
    position: relative;
    top: 0;
    height: calc(100vh - 48px);
    padding-top: .5rem;
    overflow-x: hidden;
    overflow-y: auto;
  }
  .sidebar .nav-link.active {
    color: #007bff;
}

.sidebar .nav-link {
    font-weight: 500;
    color: #333;
}
.sidebar .nav-link .feather {
    margin-right: 4px;
    color: #999;
}
.sidebar .nav-link:hover .feather, .sidebar .nav-link.active .feather {
    color: inherit;
}
.feather {
    width: 16px;
    height: 16px;
    vertical-align: text-bottom;
}

.nav-item i {
  width: 16px;
    height: 16px;
    vertical-align: text-bottom;
}
.sidebar .nav-link:hover i{
  color: inherit;
}
.nav-item .child_menu li{
  padding-left: 25px;
}
[role="main"] {
    padding-top: 60px;
    /* padding-left: 35px !important; */
}
/* 设置持续时间和动画函数 */
.slide-fade-enter-active {
  transition: all .3s ease;
}
.slide-fade-leave-active {
  transition: all .0s cubic-bezier(1.0, 0.5, 0.8, 1.0);
}
.slide-fade-enter, .slide-fade-leave-to
/* .slide-fade-leave-active for below version 2.1.8 */ {
  transform: translateX(10px);
  opacity: 0;
}
  </style>
</head>
<body>
  <div id="app">
    <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
      <a class="navbar-brand col-md-2 mr-0" href="#">Company name</a>
      
      <div class="navbar-collapse">
        <nav class="navbar navbar-dark bg-dark">
          <button class="navbar-toggler" type="button">
            <span class="navbar-toggler-icon"></span>
          </button>
        </nav>
      </div>

      @{{groupId ? groupId : 'no'}}
      <div class="btn-group">
        <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <img src="https://www.gravatar.com/avatar/8c005e78ac364acbe04652ff48d9b02c.jpg" width="30px" height="30px" class="rounded-circle">
          @{{name}}
        </button>
        <div class="dropdown-menu dropdown-menu-right">
          <button class="dropdown-item" type="button" @click="logout"><i class="fas fa-sign-out-alt"></i> Log Out</button>
        </div>
      </div>
      &nbsp;
    </nav>

    <div class="container-fluid">
      <div class="row">
        {{-- Left nav --}}
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
          <div class="sidebar-sticky">
            
            <menu-tree></menu-tree>
          
          </div>
        </nav>
        {{-- Left nav end --}}

        {{-- Main --}}
        <main role="main" class="col-md-10 ml-sm-auto px-4">
          @yield('content')
        </main>
        {{-- Main end --}}
      </div>
    </div>

  </div>

  @yield('script')
</body>
</html>
