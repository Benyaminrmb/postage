@if (isset($slot) && !is_null($slot))
@section ('breadcrumbs')
    {{ Breadcrumbs::render(Request::route()->getName(), $slot) }}
@endsection
@endif
