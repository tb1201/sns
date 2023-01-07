@csrf
<div class="md-form">
  <label>タイトル</label>
  <input type="text" name="title" class="form-control" required value="{{ $article->title ?? old('title') }}">
</div>
<div class="form-group"><!--タグ表示-->
  <article-tags-input
  :initial-tags='@json($tagNames ?? [])'
  :autocomplete-items='@json($allTagNames ?? [])'
  >
  </article-tags-input>
</div>
<div class="form-group">
  <label></label>
  <textarea name="body" required class="form-control" rows="16" placeholder="本文" wrap="hard">{{ $article->body ?? old('body') }}</textarea>
</div>
<div class="form-group row">
    <label class="col-md-1">画像</label>
    <div class="col-md-11">
        <input type="file" name="image" class="form-control-file">
    </div>
</div>