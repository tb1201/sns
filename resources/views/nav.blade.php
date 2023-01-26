<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
  <div class="container">
    <a class="navbar-brand mouseover" href="/"><img src="{{ asset('img/coffee_icon32.png')}}"></a>
    
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-center" id="navbarNavDropdown">
      <ul class="navbar-nav ml-auto mr-auto">
        <li class="nav-item mr-5">
          <a class="nav-link active mouseover" href="{{ route('info') }}">概要</a>
        </li>
        <li class="nav-item mr-5">
          <a class="nav-link mouseover" href="{{ route('operate') }}">使い方</a>
        </li>
        @guest
        <li class="nav-item mr-5">
          <a class="nav-link mouseover" href="{{ route('register') }}">ユーザー登録</a>
        </li>
        @endguest
        @guest
        <li class="nav-item mr-5">
          <a class="nav-link mouseover" href="{{ route('login') }}">ログイン</a>
        </li>
        @endguest
        @auth
        <li class="nav-item mr-5">
          <a class="nav-link mouseover" href="{{ route('articles.create') }}">投稿する</a>
        </li>
        @endauth
      </ul>
      @auth
      <!-- Dropdown -->
      <ul class="navbar-nav">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle mouseover d-flex align-items-center" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <!--<i class="fas fa-user-circle fa-lg"></i>-->
            <div class="nav-profile-image">
              @if( Auth::user()->profile_photo !== NULL )
                <img src="{{ secure_asset('storage/profilePhoto/' . Auth::user()->profile_photo) }}" alt="avatar" />
              @else
                <img src="{{ secure_asset('img/person.png') }}">
              @endif
            </div>
          </a>
          <div class="dropdown-menu dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
            <div class="user-name">{{ Auth::user()->name }}</div>
            <div class="dropdown-divider"></div>
            <button class="dropdown-item" type="button" onclick="location.href='{{ route("users.show", ["name" => Auth::user()->name]) }}'">
              マイページ
            </button>
            <button class="dropdown-item" type="button" onclick="location.href='{{ route("users.edit", ["name" => Auth::user()->name]) }}'">
              プロフィール
            </button>
            <button class="dropdown-item" type="button" onclick="location.href='{{ route("users.password", ["name" => Auth::user()->name]) }}'">
              パスワードを変更する
            </button>
            <div class="dropdown-divider"></div>
            <button form="logout-button" class="dropdown-item" type="submit">
              ログアウト
            </button>
          </div>
        </li>
          
        <form id="logout-button" method="POST" action="{{ route('logout') }}">
          @csrf
        </form>
      </ul>
      <!-- Dropdown -->
      @endauth
    </div>
  </div>
</nav>
