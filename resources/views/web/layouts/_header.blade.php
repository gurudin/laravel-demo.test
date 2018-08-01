<nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
  <div class="container">
    <a class="navbar-brand" href="{{ url('/') }}">
      {{ config('app.name') }}
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
            aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarCollapse">
      <ul class="navbar-nav mr-auto">
        <li>
          <a href="{{ url('/') }}" class="nav-link"> 首页<span class="sr-only"></span></a>
        </li>

        @foreach (\App\Support\Helper::getCategory() as $category)
        <li>
          <a href="{{ route('categories.show', $category['id']) }}" class="nav-link"> {{ $category['name'] }}<span class="sr-only"></span></a>
        </li>
        @endforeach

      </ul>

      <ul class="navbar-nav">
        <!-- Authentication Links -->
        @guest
          <li class="nav-item">
            <a class="nav-link" href="{{ route('login') }}">登录</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('register') }}">注册</a>
          </li>
        @else
          <li class="nav-item">
            <form class="form-inline mt-2 mt-md-0">
              <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
              <button class="btn btn-outline-info my-2 my-sm-0" type="submit">Search</button>
            </form>
          </li>
          <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
               aria-haspopup="true" aria-expanded="false">
              <span>
                <img class="rounded-circle"
                  src="{{ Auth::user()->avatar }}" width="30px"
                  height="30px" alt="头像">
              </span>
              {{ Auth::user()->name }}
              <span class="caret"></span>
            </a>

            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
              <a href="{{ route('users.show', Auth::id()) }}" class="dropdown-item">
                <i class="fas fa-user"></i> 个人中心
              </a>
              <a href="{{ route('users.edit', Auth::id()) }}" class="dropdown-item">
                <i class="fas fa-edit"></i> 编辑资料
              </a>
              <a href="{{ route('logout') }}" class="dropdown-item"
                 onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt"></i> 退出登录
              </a>

              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
              </form>
            </div>
          </li>
        @endguest
      </ul>
    </div>
  </div>
</nav>