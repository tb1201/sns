<div class="card mt-3">
  <div class="card-body d-flex flex-row">
    <div class="mouseover">
      <a href="{{ route('users.show', ['name' => $person->name]) }}" class="text-dark mouseover">
        <i class="fas fa-user-circle fa-3x"></i>
      </a>
      <h2 class="h5 card-title m-0">
        <a href="{{ route('users.show', ['name' => $person->name]) }}" class="text-dark mouseover">{{ $person->name }}</a>
      </h2>
    </div>
    @if( Auth::id() !== $person->id )
      <follow-button
        class="ml-auto"
        :initial-is-followed-by='@json($person->isFollowedBy(Auth::user()))'
        :authorized='@json(Auth::check())'
        endpoint="{{ route('users.follow', ['name' => $person->name]) }}"
      >
      </follow-button>
    @endif
  </div>
</div>
