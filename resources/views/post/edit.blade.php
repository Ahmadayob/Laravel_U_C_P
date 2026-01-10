<x-layout :title="$pageTitle">
    <form method="POST" action="/blog/{{ $post->id }}">
        @csrf
        @method('PATCH')

        <input type="hidden" name="id" value="{{ $post->id }}" />


        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">
                <h2 class="text-base/7 font-semibold text-gray-900">
                    Edit Post {{ $post->title }}
                </h2>
                <p class="mt-1 text-sm/6 text-gray-600">
                    Use this form to update post data for the blog.
                </p>

                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-3">
                        <label for="title" class="block text-sm/6 font-medium text-gray-900">
                            Title
                        </label>
                        <div class="mt-2">
                            <input 
                                id="title" 
                                value="{{ old('title', $post->title) }}" 
                                type="text" 
                                name="title"
                                class="block w-full rounded-md border-2 border-gray-300 bg-white px-3 py-2 text-base text-gray-900 placeholder:text-gray-400 focus:border-indigo-600 focus:ring-2 focus:ring-indigo-600 sm:text-sm/6" 
                            />
                        </div>
                        @error('title')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="sm:col-span-3">
                        <label for="author" class="block text-sm/6 font-medium text-gray-900">
                            Author
                        </label>
                        <div class="mt-2">
                            <input 
                                id="author" 
                                value="{{ old('author', $post->author) }}" 
                                type="text" 
                                name="author"
                                class="block w-full rounded-md border-2 border-gray-300 bg-white px-3 py-2 text-base text-gray-900 placeholder:text-gray-400 focus:border-indigo-600 focus:ring-2 focus:ring-indigo-600 sm:text-sm/6" 
                            />
                        </div>
                        @error('author')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-span-full">
                        <label for="body" class="block text-sm/6 font-medium text-gray-900">
                            Content
                        </label>
                        <div class="mt-2">
                            <textarea 
                                id="body" 
                                name="body" 
                                rows="3"
                                class="block w-full rounded-md border-2 border-gray-300 bg-white px-3 py-2 text-base text-gray-900 placeholder:text-gray-400 focus:border-indigo-600 focus:ring-2 focus:ring-indigo-600 sm:text-sm/6"
                            >{{ old('body', $post->body) }}</textarea>
                        </div>
                        <p class="mt-3 text-sm/6 text-gray-600">
                            Write a few sentences about the article.
                        </p>
                        @error('body')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-span-full">
                        <div class="flex gap-3">
                            <div class="flex h-6 shrink-0 items-center">
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input 
                                        id="published"
                                        name="published"
                                        type="checkbox" 
                                        value="1"
                                        {{ old('published')||(!old() && $post->published) ? 'checked' : '' }}
                                        aria-describedby="published-description"
                                        class="w-5 h-5 border-2 border-gray-300 rounded bg-white checked:bg-indigo-600 checked:border-indigo-600 appearance-none cursor-pointer transition-colors"
                                        style="background-image: none;" 
                                    />
                                    <svg 
                                        class="absolute w-3.5 h-3.5 text-white pointer-events-none"
                                        style="left: 0.125rem; top: 0.125rem; display: none;" 
                                        fill="none"
                                        stroke="currentColor" 
                                        viewBox="0 0 24 24"
                                    >
                                        <path 
                                            stroke-linecap="round" 
                                            stroke-linejoin="round" 
                                            stroke-width="3"
                                            d="M5 13l4 4L19 7"
                                        ></path>
                                    </svg>
                                </label>
                            </div>
                            <div class="text-sm/6">
                                <label for="published" class="font-medium text-gray-900">
                                    Is published?
                                </label>
                                <p id="published-description" class="text-gray-500">
                                    Do you want to publish or save as draft.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-6 flex items-center justify-end gap-x-6">
            <a href="/blog" class="text-sm/6 font-semibold text-gray-900">Cancel</a>
            <button 
                type="submit"
                class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
            >Save</button>
        </div>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const checkbox = document.getElementById('published');
            const checkmark = checkbox.nextElementSibling;
            
            if (checkbox.checked) {
                checkmark.style.display = 'block';
            }
            
            checkbox.addEventListener('change', function() {
                if (this.checked) {
                    checkmark.style.display = 'block';
                } else {
                    checkmark.style.display = 'none';
                }
            });
        });
    </script>
</x-layout>