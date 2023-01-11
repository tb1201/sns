@extends('app')

@section('title', $user->name . 'のいいねした記事')

@section('content')
  @include('nav')
  <div class="container pb-5">
    @include('users.user')
    
    @include('users.tabs', ['hasArticles' => false, 'hasLikes' => true])
    
    <div class="row">
      @foreach($articles as $article)
        @include('articles.card')
      @endforeach
    </div>
  </div>
@endsection
