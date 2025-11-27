<div class="container">
    <h1>Blog Posts</h1>
    @if($posts->isEmpty())
        <p>No posts available.</p>
    @else
        <ul>
            @foreach($posts as $post)
                <li>
                    <h2>{{ $post->title }}</h2>
                    <p>{{ $post->body }}</p>
                    <small>Published: {{ $post->published ? 'Yes' : 'No' }}</small>
                </li>
            @endforeach
        </ul>
    @endif
</div>
