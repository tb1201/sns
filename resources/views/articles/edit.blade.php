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
              <form method="POST" action="{{ route('articles.update', ['article' => $article]) }}" enctype="multipart/form-data">
                @method('PATCH')
                @include('articles.update')
                <button type="submit" class="btn bg-dark bg-gradient text-white btn-block mouseover">更新する</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
