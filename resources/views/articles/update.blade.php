<div class="md-form">
  <label>タイトル</label>
  <input type="text" name="title" class="form-control" required value="{{ $article->title ?? old('title') }}" form="postField">
</div>

<!--タグ表示-->
<div class="form-group">
  <article-tags-input
  :initial-tags='@json($tagNames ?? [])'
  :autocomplete-items='@json($allTagNames ?? [])'
  >
  </article-tags-input>
</div>

<div class="form-group">
  <label></label>
  <textarea name="body" required class="form-control" rows="8" placeholder="本文" wrap="hard" form="postField">{{ $article->body ?? old('body') }}</textarea>
</div>
<div class="form-group row">
    <label class="col-md-1">画像</label>
    <div class="col-md-11">
        <input type="file" name="image" class="form-control-file" form="postField">
        @if( $article->image_path !== NULL )
          <div class="form-text text-info">
            <!--設定中：{{ $article->image_path }}-->
            画像登録済み
          </div>
          <div class="form-check">
              <label class="form-check-label">
                  <input type="checkbox" class="form-check-input" name="remove" value="true" form="postField">画像を削除
              </label>
          </div>
        @endif
    </div>
</div>

<form method="POST" action="{{ route('articles.update', ['article' => $article]) }}" enctype="multipart/form-data" id="postField">
  @method('PATCH')
  @csrf
  <button type="submit" class="btn bg-dark bg-gradient text-white btn-block mouseover">更新する</button>
</form>