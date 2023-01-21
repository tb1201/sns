@extends('app')

@section('title', $user->name. 'のマイページ')

@section('content')
  @include('nav')
  <div class="container pb-5">
    @include('users.user')
    
    @include('users.tabs', ['hasArticles' => true, 'hasLikes' => false])

    <div class="row">
      @foreach($articles as $article)
        @include('articles.card')
      @endforeach
    </div>
  </div>
@endsection
