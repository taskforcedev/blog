@extends($layout)

@section('content')
    @if(isset($posts) && count($posts) > 0)
        @foreach($posts as $post)
            <div class="row">
                <div class="medium-12 columns">
                    <div class="blog-post">
                        <div class="blog-post">
                            <h1>{{ $post->title }} <small>- {{ $post->created_at }}</small></h1>
                            <!-- img class="thumbnail" src="http://placehold.it/850x350" -->
                            {{ $post->body }}
                            <div class="callout">
                                <ul class="menu simple">
                                    <li><a href="#">Author: {{ $post->author->name }}</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <div class="row">
            <div class="medium-12 columns">
                <p>There are currently no posts to view.</p>
            </div>
        </div>
    @endif
@endsection
