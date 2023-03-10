<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
  <div class="container">
    <a class="navbar-brand mouseover" href="/">
      <img src="{{ asset('img/coffee_icon32.png') }}" width="32" height="32" alt="ホームアイコン">
    </a>
    
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-center" id="navbarNavDropdown">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item mr-5">
          <a class="nav-link active mouseover" href="/">ホーム</a>
        </li>
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
            <div class="nav-profile-image">
            @if( Auth::user()->profile_photo !== NULL )
              <span class="nav-img-inner" style="background-image: url({{ secure_asset('storage/profilePhoto/' . Auth::user()->profile_photo) }})"></span>
            @else
              <span class="nav-img-inner" style="background-image: url({{ secure_asset('img/person.png') }})"></span>
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
            <button form="user-delete" class="dropdown-item" type="submit" onclick='return confirm("退会します。よろしいですか？");'>
              退会する
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
        
        <form id="user-delete" method="POST" action="{{ route("users.accountDelete", ["name" => Auth::user()->name]) }}">
          @csrf
          @method('DELETE')
        </form>
        
      </ul>
      <!-- Dropdown -->
      @endauth
    </div>
  </div>
</nav>
