@if(Auth::user()->is_completed == 'false' || Auth::user()->is_completed == 'pending' || Auth::user()->is_completed == 'revision')

    @include('auth.verify-register')
@else
    @include('dashboard')
@endif
