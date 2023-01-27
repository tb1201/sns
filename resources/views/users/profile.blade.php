@extends('app')

@section('title', 'プロフィール')

@section('content')
  @include('nav')
  <div class="container-fluid">
    <div class="row">
      <div class="col-12 py-5">
        <div class="card">
          <div class="card-body pt-0">
            @include('error_card_list')
            <div class="card-text">
              <form method="POST" class="edit_user" action="{{ route('users.update', ['name' => $user->name]) }}" enctype="multipart/form-data">
                @method('PATCH')
                @csrf

                <div class="md-form">
                  <label for="name">ユーザー名</label>
                  <input autofocus="autofocus" id="name" class="form-control" type="text" required value="{{ $user->name ?? old('name') }}" name="name" />
                </div>
                
                <div class="form-group mb-4">
                  <label for="image">プロフィール画像</label>
                  <div class="row">
                    <div class="col-md-2">
                      <div class="profile-image">
                        @if( $user->profile_photo !== NULL )
                          <img src="{{ secure_asset('storage/profilePhoto/' . $user->profile_photo) }}" alt="avatar" />
                        @else
                          <img src="{{ secure_asset('img/person.png') }}">
                        @endif
                      </div>
                    </div>
                    <div class="col-md-10">
                      <div class="my-3 ml-2">
                        <input type="file" name="image" class="form-control-file">
                      </div>
                      @if( $user->profile_photo !== NULL )
                      <div class="form-check ml-2">
                        <label class="form-check-label">
                          <input type="checkbox" class="form-check-input" name="remove" value="true">画像を削除
                        </label>
                      </div>
                      @endif
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <label for="self-introduction">自己紹介</label>
                  <textarea name="self_introduction" class="form-control" rows="4" wrap="hard" name="self-introduction">{{ $user->self_introduction ?? old('self_introduction') }}</textarea>
                </div>

                <div class="form-group mb-4">
                  <label for="email">メールアドレス</label>
                  <input autofocus="autofocus" class="form-control" type="email" required value="{{ $user->email ?? old('email') }}" name="email" />
                </div>
  
                <button type="submit" class="btn bg-dark bg-gradient text-white btn-block mouseover">更新する</button>
              </form>
            </div>  
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
