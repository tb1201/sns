<div class="col-md-4">
  <div class="card my-4 shadow-sm">
    @if ($article->image_path)
      <div class="card-img-top card-img-size">
        <a class="text-dark mouseover" href="{{ route('articles.show', ['article' => $article]) }}">
          <img src="{{ secure_asset('storage/image/' . $article->image_path) }}">
        </a>
      </div>
    @else
      <div class="card-img-top card-img-size">
        <a class="text-dark mouseover" href="{{ route('articles.show', ['article' => $article]) }}">
          <img src="{{ secure_asset('img/20200501_noimage.png') }}">
        </a>
      </div>
    @endif
    
    <div class="card-body d-flex flex-row">
      <a href="{{ route('users.show', ['name' => $article->user->name]) }}" class="text-dark mouseover">
        <i class="fas fa-user-circle fa-3x mr-1"></i>
      </a>
      <div>
        <a href="{{ route('users.show', ['name' => $article->user->name]) }}" class="text-dark mouseover">
          <div class="font-weight-bold">{{ $article->user->name }}</div>
        </a>
        <div class="font-weight-lighter">{{ $article->created_at->format('Y/m/d H:i') }}</div>
      </div>
  
    @if( Auth::id() === $article->user_id )
      <!-- dropdown -->
        <div class="ml-auto card-text">
          <div class="dropdown">
            <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-ellipsis-v"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
              <a class="dropdown-item" href="{{ route("articles.edit", ['article' => $article]) }}">
                <i class="fas fa-pen mr-1"></i>記事を更新する
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item text-danger" data-toggle="modal" data-target="#modal-delete-{{ $article->id }}">
                <i class="fas fa-trash-alt mr-1"></i>記事を削除する
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
    
    <div class="card-body pt-0 pb-2">
      <h5 class="card-title card-title-style mb-2">
        <a class="text-dark mouseover" href="{{ route('articles.show', ['article' => $article]) }}">
          {{ $article->title }}
        </a>
      </h5>
      <div class="card-text line-limit">
        {{ $article->body }}
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
    
    <div class="card-body pt-0 pb-2 pl-3">
      <div class="card-text line-height line-limit-tag">
        @foreach($article->tags as $tag)
                <a href="{{ route('tags.show', ['name' => $tag->name]) }}" class="p-1 mr-1 mt-1">
                  {{ $tag->hashtag }}
                </a>
        @endforeach
      </div>
    </div>
    
  </div>
</div>