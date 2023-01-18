@extends('app')

@section('title', 'Iwate Coffee Shop Exploration')

@section('content')
  @include('nav')
  <!--slide show-->
  <div class="slide">
    <p>Iwate<br> Coffee Shop Exploration</p>
    <img src="{{ secure_asset('img/cafe-7588632_1280.jpg') }}" alt="">
    <img src="{{ secure_asset('img/coffee-4585744_1280.jpg') }}" alt="">
    <img src="{{ secure_asset('img/cafe-1869656_1280.jpg') }}" alt="">
  </div>
  
  
  <div class="container py-5">
    <div class="row">
      @foreach($articles as $article)
      @include('articles.card')
      @endforeach
    </div>
  </div>
@endsection