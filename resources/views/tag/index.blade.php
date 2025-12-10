<x-layout :title="$pageTitle">
    <h2>Tags</h2>
    @foreach ($tags as $tag)
        <h1 class="text-2xl">{{ $tag->title }}</h1>
        <p>{{ $tag->body }}</p>
    @endforeach
</x-layout>