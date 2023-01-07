@extends('app')

@section('title', '記事一覧')

@section('content')
    @include('nav')
    <div>
        <img src="{{ asset('img/cafe-1869656_.jpg')}}" class="img-fluid">
    </div>
    
    <div class="py-5">
        <div class="container">
            <div class="row">
                @foreach($articles as $article)
                  @include('articles.card')
                @endforeach
            </div>
        </div>
    </div>
@endsection