<div class="card mt-3">
  <div class="card-body d-flex flex-row">
    <div>
      <div class="profile-image">
        @if( $user->profile_photo !== NULL )
          <img src="{{ secure_asset('storage/profilePhoto/' . $user->profile_photo) }}" alt="avatar" />
        @else
          <img src="{{ secure_asset('img/person.png') }}">
        @endif
      </div>

      <h2 class="h4 card-title">
        {{ $user->name }}
      </h2>
      <div class="card-text white_space">
        {{ $user->self_introduction }}
      </div>
    </div>
    @if( Auth::id() !== $user->id )
      <follow-button
        class="ml-auto"
        :initial-is-followed-by='@json($user->isFollowedBy(Auth::user()))'
        :authorized='@json(Auth::check())'
        endpoint="{{ route('users.follow', ['name' => $user->name]) }}"
      >
      </follow-button>
    @endif
  </div>
  <div class="card-body">
    <div class="card-text">
      <a href="{{ route('users.followings', ['name' => $user->name]) }}" class="text-dark mouseover mr-3">
        {{ $user->count_followings }} フォロー
      </a>
      <a href="{{ route('users.followers', ['name' => $user->name]) }}" class="text-dark mouseover">
        {{ $user->count_followers }} フォロワー
      </a>
    </div>
  </div>
</div>
