@extends('app')

@section('title', $user->name)

@section('content')
  @include('nav')
  <div class="container">
    @include('users.user')
    
    @include('users.tabs', ['hasArticles' => true, 'hasLikes' => false])

    <div class="py-5 bg-gray">
      <div class="row">
        @foreach($articles as $article)
          @include('articles.card')
        @endforeach
      </div>
    </div>
  </div>
@endsection
