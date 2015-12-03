@extends($layout)

@section('content')
    @if(isset($posts) && count($posts) > 0)
        @foreach($posts as $post)
        @endforeach
    @else
        <p>There are currently no posts to view.</p>
    @endif
@endsection
