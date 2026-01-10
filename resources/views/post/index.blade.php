<x-layout :title="$pageTitle">

    @if (session('success'))
        <div class="bg-green-50 px-3 py-2">
            {{ session('success') }}
        </div>
    @endif

    {{-- Only show Create button to admin and editor --}}
    @can('create', App\Models\Post::class)
        <div class="mt-6 flex items-center justify-end gap-x-6">
            <a href="/blog/create"
                class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Create</a>
        </div>
    @endcan

    @foreach ($posts as $post)
        <div class="flex justify-between items-center border border-gray-200 px-4 py-6 my-2">
            <div>
                <h1 class="text-2xl">
                    <a href="/blog/{{ $post->id }}">{{ $post->title }}</a>
                </h1>
                <p class="text-1xl">{{ $post->author }}</p>
                @if($post->user)
                    <p class="text-sm text-gray-500">Posted by: {{ $post->user->name }} ({{ ucfirst($post->user->role) }})</p>
                @endif
            </div>
            <div class="flex gap-2">
                {{-- Only show Edit button if user can update this post --}}
                @can('update', $post)
                    <a class="text-yellow-500 hover:text-gray-500" href="/blog/{{ $post->id }}/edit">Edit</a>
                @endcan

                {{-- Only show Delete button if user can delete this post --}}
                @can('delete', $post)
                    <form method="POST" action="/blog/{{ $post->id }}"
                        onsubmit="return confirm('Are you sure you want to delete this post?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:text-gray-500">Delete</button>
                    </form>
                @endcan
            </div>
        </div>
    @endforeach

    {{ $posts->links()  }}
</x-layout>