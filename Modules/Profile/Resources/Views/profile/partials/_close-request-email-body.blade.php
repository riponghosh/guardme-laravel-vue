<h1>Close Account Request from {{ $email }}</h1>

@if (!empty($reasons))
<h2>Reasons:</h2>
    @foreach($reasons as $key => $val)
        <p>{{ $val }}</p>
    @endforeach
    <p>{{ $more_info }}</p>
@endif
