<x-layout :title="$pageTitle">
    <div class="max-w-4xl mx-auto">
        <!-- Post Content -->
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">{{ $post->title }}</h1>
            <div class="flex items-center justify-between mb-6">
                <div>
                    <p class="text-sm text-gray-600">By {{ $post->author }}</p>
                    @if($post->user)
                        <p class="text-xs text-gray-500">Posted by: {{ $post->user->name }}
                            ({{ ucfirst($post->user->role) }})</p>
                    @endif
                </div>
                <div class="flex gap-2">
                    @can('update', $post)
                        <a href="/blog/{{ $post->id }}/edit"
                            class="rounded-md bg-yellow-500 px-3 py-2 text-sm font-semibold text-white hover:bg-yellow-600">
                            Edit
                        </a>
                    @endcan
                    @can('delete', $post)
                        <form method="POST" action="/blog/{{ $post->id }}" onsubmit="return confirm('Are you sure?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="rounded-md bg-red-500 px-3 py-2 text-sm font-semibold text-white hover:bg-red-600">
                                Delete
                            </button>
                        </form>
                    @endcan
                </div>
            </div>
            <div class="prose prose-lg text-gray-700">
                <p>{{ $post->body }}</p>
            </div>
        </div>

        <div class="border-t border-gray-200 pt-8">
            <!-- Add Comment Form -->
            <div class="mb-12">
                <h2 class="text-2xl font-semibold text-gray-900 mb-6">Add a Comment</h2>

                <form method="POST" action="/comments">
                    @csrf
                    <input type="hidden" name="post_id" value="{{ $post->id }}" />

                    <div class="space-y-6">
                        <div>
                            <label for="author" class="block text-sm font-medium text-gray-900 mb-2">
                                Your Name
                            </label>
                            <input id="author" type="text" name="author" value="{{ old('author') }}"
                                placeholder="Enter your name"
                                class="block w-full rounded-md border-2 border-gray-300 bg-white px-3 py-2 text-base text-gray-900 placeholder:text-gray-400 focus:border-indigo-600 focus:ring-2 focus:ring-indigo-600 sm:text-sm"
                                required />
                            @error('author')
                                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="content" class="block text-sm font-medium text-gray-900 mb-2">
                                Comment
                            </label>
                            <textarea id="content" name="content" rows="4" placeholder="Write your comment here..."
                                class="block w-full rounded-md border-2 border-gray-300 bg-white px-3 py-2 text-base text-gray-900 placeholder:text-gray-400 focus:border-indigo-600 focus:ring-2 focus:ring-indigo-600 sm:text-sm"
                                required>{{ old('content') }}</textarea>
                            @error('content')
                                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="flex justify-end">
                            <button type="submit"
                                class="rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                                Post Comment
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Display Comments -->
            <div>
                <h2 class="text-2xl font-semibold text-gray-900 mb-6">
                    Comments ({{ $post->comments->count() }})
                </h2>

                @if($post->comments->count() > 0)
                    <div class="space-y-6">
                        @foreach ($post->comments as $comment)
                            <div class="bg-gray-50 rounded-lg p-6 border border-gray-200">
                                <div class="flex items-start justify-between mb-3">
                                    <div>
                                        <h3 class="font-semibold text-gray-900">{{ $comment->author }}</h3>
                                        <p class="text-xs text-gray-500">
                                            {{ $comment->created_at->diffForHumans() }}
                                        </p>
                                    </div>
                                </div>
                                <p class="text-gray-700">{{ $comment->content }}</p>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-12 bg-gray-50 rounded-lg border border-gray-200">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                            </path>
                        </svg>
                        <h3 class="mt-4 text-sm font-medium text-gray-900">No comments yet</h3>
                        <p class="mt-1 text-sm text-gray-500">Be the first to comment on this post!</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Back to Blog Button -->
        <div class="mt-8 pt-6 border-t border-gray-200">
            <a href="/blog" class="inline-flex items-center text-sm font-medium text-indigo-600 hover:text-indigo-500">
                <svg class="mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back to Blog
            </a>
        </div>
    </div>
</x-layout>