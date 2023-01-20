@extends('app')

@section('title', $user->name . 'のフォロワー')

@section('content')
  @include('nav')
  <div class="container pb-5">
    @include('users.user')
    @include('users.tabs', ['hasArticles' => false, 'hasLikes' => false])
    @foreach($followers as $person)
      @include('users.person')
    @endforeach
  </div>
@endsection
