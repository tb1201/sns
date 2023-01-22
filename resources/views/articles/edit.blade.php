@extends('app')

@section('title', '記事更新')

@section('content')
  @include('nav')
  <div class="container-fluid">
    <div class="row">
      <div class="col-12 py-5">
        <div class="card">
          <div class="card-body pt-0">
            @include('error_card_list')
            <div class="card-text">
              @include('articles.update')
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
