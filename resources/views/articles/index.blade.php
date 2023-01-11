@extends('app')

@section('title', '記事一覧')

@section('content')
    @include('nav')
    <!--slide show-->
    <div id="slide-container">
        <h1>Iwate<br> Coffee Shop Exploration</h1>
        <div class="slide">
          <img src="{{ secure_asset('img/cafe-7588632_1280.jpg') }}" alt="">
          <img src="{{ secure_asset('img/coffee-4585744_1280.jpg') }}" alt="">
          <img src="{{ secure_asset('img/cafe-1869656_1280.jpg') }}" alt="">
        </div>
    </div>
    
    <div class="container py-5">
        <div class="row">
            @foreach($articles as $article)
              @include('articles.card')
            @endforeach
        </div>
    </div>
@endsection