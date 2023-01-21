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
    </div>
</div>

<form method="POST" action="{{ route('articles.store') }}" enctype="multipart/form-data" id="postField">
  @csrf
  <button type="submit" class="btn bg-dark bg-gradient text-white btn-block mouseover">投稿する</button>
</form>