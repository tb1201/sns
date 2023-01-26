@extends('app')

@section('title', 'パスワード変更')

@section('content')
  @include('nav')
  <div class="container-fluid">
    <div class="row">
      <div class="col-12 py-5">
        <div class="card">
          <div class="card-body pt-0">
            @include('error_card_list')
            <div class="card-text">
                <h4 class="h4 my-3">ユーザー名　{{ $user->name }}</h2>
                <form method="POST" class="edit_user" action="{{ route('users.passwordUpdate', ['name' => $user->name]) }}" enctype="multipart/form-data">
                    @method('PATCH')
                    @csrf
    
                    <div class="form-group">
                      <label for="current_password">現在のパスワード</label>
                      <input autofocus="autofocus" class="form-control" type="password" value="{{ old('current_password') }}" name="current_password" />
                    </div>
                    
                    <div class="form-group">
                      <label for="password">新しいパスワード</label>
                      <input autofocus="autofocus" class="form-control" type="password" value="{{ old('password') }}" name="password" />
                    </div>
    
                    <div class="form-group mb-4">
                      <label for="password_confirmation">新しいパスワード（確認用）</label>
                      <input autofocus="autofocus" class="form-control" type="password" name="password_confirmation" />
                    </div>
      
                    <button type="submit" class="btn bg-dark bg-gradient text-white btn-block mouseover">パスワードを更新</button>
                </form>
            </div>  
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
