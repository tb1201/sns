<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <!--OGP-->
    <meta property="og:url" content="https://myapp1210.mydns.jp/" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="Iwate Coffee Shop Exploration | 岩手コーヒーショップ探訪" />
    <meta property="og:description" content="岩手県盛岡市は、2020年のコーヒー消費量が全国5位。岩手県内のおすすめのカフェ、喫茶店などを投稿することができるサイトです。" />
    <meta property="og:site_name" content="Iwate Coffee Shop Exploration | 岩手コーヒーショップ探訪" />
    <meta property="og:image" content="https://myapp1210.mydns.jp/img/toppage.png" />
    <!--OGP-->
    <title>
    @yield('title')
    </title>
    <meta name="description" content="岩手県盛岡市は、2020年のコーヒー消費量が全国5位。岩手県内のおすすめのカフェ、喫茶店などを投稿することができるサイトです。">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <!-- Bootstrap core CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.11/css/mdb.min.css" rel="stylesheet">
    
    <link href="{{ mix('css/style.css') }}" rel="stylesheet">
    <link href="{{ mix('css/article.css') }}" rel="stylesheet">
    <link href="{{ mix('css/slideshow.css') }}" rel="stylesheet">
  </head>

  <body>
    <div id="app">
    @yield('content')
    </div>
    
    <script src="{{ mix('js/app.js') }}"></script>
    <!-- JQuery -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.11/js/mdb.min.js"></script>
    
    <footer class="footer">
      <div class="container">
        <p class="text-muted text-center text-small">&copy;2023 Yutaka Suzuki</p>
      </div>
    </footer>
  </body>
</html>
