@extends('app')

@section('title', '使い方')

@section('content')
  @include('nav')
  <div class="container">
    <div class="container-fluid px-2">
      <h3 class="h3 oper-headline">ユーザー登録</h3>
      <p>ユーザー名は、英数字3～16文字で入力してください。登録後の変更はできません。</p>
      <p>メールアドレス、パスワードを入力後、ユーザー登録ボタンを押してください。</p>
      <p class="oper-img-size">
        <img src="{{ secure_asset('img/register.png') }}">
      </p>
      
      <h3 class="h3 oper-headline">ログイン</h3>
      <p>ユーザー登録で入力したメールアドレス、パスワードを入力しログインボタンを押してください。</p>
      <p class="oper-img-size mb-5">
        <img src="{{ secure_asset('img/login.png') }}">
      </p>
      
      <h3 class="h3 oper-headline">投稿する</h3>
      <p>タイトルと本文は、必須入力、タグと画像は省略可能です。</p>
      <p>タグは、文字を入力後、TabキーかEnterキーを押すと先頭に#が付きます。</p>
      <p class="oper-img-size mb-5">
        <img src="{{ secure_asset('img/post.png') }}">
      </p>
      
      <h3 class="h3 oper-headline">記事を更新する、記事を削除する</h3>
      <p>ご自身が投稿した記事には、編集ボタン（赤枠部分）が表示されています。</p>
      <p>編集ボタンをクリックすると、記事を更新する、記事を削除するメニューが表示されます。</p>
      <p class="oper-img-size mb-5">
        <img src="{{ secure_asset('img/edit.png') }}">
      </p>
      <p>記事更新</p>
      <p class="oper-img-size mb-5">
        <img src="{{ secure_asset('img/edit1.png') }}">
      </p>
      
      <h3 class="h3 oper-headline">マイページ</h3>
      <p>画面右上の人型のアイコンをクリックすると、マイページとログアウトのメニューが表示されます。</p>
      <p class="oper-img-size mb-5">
        <img src="{{ secure_asset('img/mypage.png') }}">
      </p>
      <p>マイページでは投稿した記事の一覧、いいねをした記事一覧を表示することができます。</p>
      <p>また、フォローをクリックすると、フォローしているユーザー一覧を表示することができます。（フォロワーも同様です。）</p>
      <p class="oper-img-size mb-5">
        <img src="{{ secure_asset('img/mypage1.png') }}">
      </p>
      <p>フォローユーザー一覧</p>
      <p class="oper-img-size mb-5">
        <img src="{{ secure_asset('img/follow.png') }}">
      </p>
      
      <h3 class="h3 oper-headline">いいね機能</h3>
      <p>いいねしたい記事のハートマークをクリックすると、ハートマークが赤色に変化します。
      <p>※ログインしていることが前提条件です。未ログインではいいね機能を使用することはできません。</p>
      <p>いいねをした記事はマイページのいいねタブで一覧表示することができます。</p>
      <p>いいねを解除する場合は、赤色のハートマークをクリックしてください。灰色に変化し、いいねが解除されます。</p>
      <p></p>
      <p class="oper-img-size mb-5">
        <img src="{{ secure_asset('img/like.png') }}">
      </p>
      
      <h3 class="h3 oper-headline">フォロー機能</h3>
      <p>フォローしたいユーザーの人型アイコン（赤枠部分）をクリックすると、ユーザーページが表示されます。</p>
      <p class="oper-img-size mb-5">
        <img src="{{ secure_asset('img/follow1.png') }}">
      </p>
      <p>画面右上のフォローボタンをクリックすることでフォローすることができます。</p>
      <p>※ログインしていることが前提条件です。未ログインではフォロー機能を使用することはできません。</p>
      <p>フォローを解除したい場合は、同じボタンをクリックすると解除することができます。</p>
      <p class="oper-img-size mb-5">
        <img src="{{ secure_asset('img/follow2.png') }}">
      </p>
      
      <h3 class="h3 oper-headline">タグ機能</h3>
      <p>同一のタグが付いた記事一覧を表示させたい場合、赤枠のタグをクリックします。</p>
      <p class="oper-img-size mb-5">
        <img src="{{ secure_asset('img/tag.png') }}">
      </p>
      <p>同一タグ一覧</p>
      <p class="oper-img-size mb-5">
        <img src="{{ secure_asset('img/tag2.png') }}">
      </p>
    </div>
  </div>
@endsection