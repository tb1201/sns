@extends('app')

@section('title', '記事一覧')

@section('content')
    @include('nav')
    <div>
        <img src="{{ asset('img/janos-venczak-s_PBKeHyv68-unsplash.jpg')}}" class="img-fluid">
    </div>
    
    <div class="py-5 bg-gray">
        <div class="container">
            <div class="row">
                @foreach($articles as $article)
                  @include('articles.card')
                @endforeach
            </div>
        </div>
    </div>
@endsection