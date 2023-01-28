<div class="card mt-3">
  <div class="card-body d-flex flex-row">
    <div class="mouseover">
      <a href="{{ route('users.show', ['name' => $person->name]) }}" class="text-dark mouseover">
        <div class="card-profile-image">
          @if( $person->profile_photo !== NULL )
            <span class="img-inner" style="background-image: url({{ secure_asset('storage/profilePhoto/' . $person->profile_photo) }})"></span>
          @else
            <span class="img-inner" style="background-image: url({{ secure_asset('img/person.png') }})"></span>
          @endif
        </div>
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
