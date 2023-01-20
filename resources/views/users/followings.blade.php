@extends('app')

@section('title', $user->name . 'のフォロー中')

@section('content')
  @include('nav')
  <div class="container pb-5">
    @include('users.user')
    @include('users.tabs', ['hasArticles' => false, 'hasLikes' => false])
    @foreach($followings as $person)
      @include('users.person')
    @endforeach
  </div>
@endsection
