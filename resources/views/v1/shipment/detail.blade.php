@if (Auth::user()->userType === 'agency')
    @extends('admin.layout.navbar')

    @section('admin.navbar')
@else

    @extends('profile.layout.app')

    @section('profile.index')

@endif
awdawd


@endsection
