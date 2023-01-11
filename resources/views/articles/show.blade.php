@extends('app')

@section('title', '記事詳細')

@section('content')
  @include('nav')
  <div class="container py-5">
    <div class="container-fluid px-2">
      <div class="card">
        @if ($article->image_path)
            <img src="{{ secure_asset('storage/image/' . $article->image_path) }}">
        @else
            <img src="{{ secure_asset('img/20200501_noimage.jpg') }}">
        @endif
        
        <div class="card-body d-flex flex-row">
          <div class="mouseover alignment">
            <a href="{{ route('users.show', ['name' => $article->user->name]) }}" class="text-dark">
              <i class="fas fa-user-circle fa-3x mr-1"></i>
            </a>
            <div>
              <a href="{{ route('users.show', ['name' => $article->user->name]) }}" class="text-dark">
                <div class="font-weight-bold">{{ $article->user->name }}</div>
              </a>
              <div class="font-weight-lighter card-text">{{ $article->created_at->format('Y/m/d H:i') }}</div>
            </div>
          </div>
      
          @if( Auth::id() === $article->user_id )
          <!-- dropdown -->
            <div class="ml-auto card-text">
              <div class="dropdown">
                <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="mouseover">
                  <i class="fas fa-edit fa-lg"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                  <a class="dropdown-item" href="{{ route("articles.edit", ['article' => $article]) }}">
                    <i class="fas fa-pen-nib mr-1"></i>記事を更新する
                  </a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item text-danger" data-toggle="modal" data-target="#modal-delete-{{ $article->id }}">
                    <i class="far fa-trash-alt mr-1"></i>記事を削除する
                  </a>
                </div>
              </div>
            </div>
            <!-- dropdown -->
      
            <!-- modal -->
            <div id="modal-delete-{{ $article->id }}" class="modal fade" tabindex="-1" role="dialog">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <form method="POST" action="{{ route('articles.destroy', ['article' => $article]) }}">
                    @csrf
                    @method('DELETE')
                    <div class="modal-body">
                      {{ $article->title }}を削除します。よろしいですか？
                    </div>
                    <div class="modal-footer justify-content-between">
                      <a class="btn btn-outline-grey" data-dismiss="modal">キャンセル</a>
                      <button type="submit" class="btn btn-danger">削除する</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <!-- modal -->
          @endif
        </div>
        
        <div class="card-body pt-0">
          <h4 class="h4 card-title">
              {{ $article->title }}
          </h4>
          <div class="card-text white_space">
            {{ $article->body }}
          </div>
        </div>
        
        <div class="card-body pt-0 pb-4 pl-3">
          <div class="card-text line-height">
            @foreach($article->tags as $tag)
                    <a href="{{ route('tags.show', ['name' => $tag->name]) }}" class="p-1 mr-1 mt-1">
                      {{ $tag->hashtag }}
                    </a>
            @endforeach
          </div>
        </div>
        
        <div class="card-body pt-0 pb-2 pl-3">
          <div class="card-text">
            <article-like
              :initial-is-liked-by='@json($article->isLikedBy(Auth::user()))'
              :initial-count-likes='@json($article->count_likes)'
              :authorized='@json(Auth::check())'
              endpoint="{{ route('articles.like', ['article' => $article]) }}"
            >
            </article-like>
          </div>
        </div>
        
      </div>
    </div>
  </div>
@endsection
