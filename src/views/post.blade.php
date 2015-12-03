@extends($layout)

@section('content')
<h1 class="{{ $classes['title'] }}">{{ $post->title }}</h1>

{{ $post->body }}

@endsection
