@extends('app')

@section('title', 'Iwate Coffee Shop Exploration | 岩手コーヒーショップ探訪')

@section('content')
  @include('nav')
  <!--slide show-->
  <div class="slide">
    <p>Iwate<br> Coffee Shop Exploration</p>
    <img src="{{ secure_asset('img/cafe-7588632_1280.jpg') }}" alt="slideshow1">
    <img src="{{ secure_asset('img/coffee-4585744_1280.jpg') }}" alt="slideshow2">
    <img src="{{ secure_asset('img/cafe-1869656_1280.jpg') }}" alt="slideshow3">
  </div>
  
  
  <div class="container py-5">
    <div class="row">
      @foreach($articles as $article)
      @include('articles.card')
      @endforeach
    </div>
  </div>
@endsection