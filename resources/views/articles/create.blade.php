@extends('app')

@section('title', '記事投稿')

@include('nav')

@section('content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-12 py-5">
        <div class="card">
          <div class="card-body pt-0">
            @include('error_card_list')
            <div class="card-text">
              <form method="POST" action="{{ route('articles.store') }}" enctype="multipart/form-data">
                @include('articles.form')
                <button type="submit" class="btn bg-dark bg-gradient text-white btn-block">投稿する</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
