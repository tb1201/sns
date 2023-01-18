<div class="card mt-3">
  <div class="card-body d-flex flex-row">
    <div>
      <i class="fas fa-user-circle fa-3x"></i>
      <h2 class="h5 card-title m-0">
        {{ $user->name }}
      </h2>
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
      <a href="{{ route('users.followings', ['name' => $user->name]) }}" class="text-dark mouseover">
        {{ $user->count_followings }} フォロー
      </a>
      <a href="{{ route('users.followers', ['name' => $user->name]) }}" class="text-dark mouseover">
        {{ $user->count_followers }} フォロワー
      </a>
    </div>
  </div>
</div>
