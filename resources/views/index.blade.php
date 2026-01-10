<x-layout :title="$title">
    <!-- Welcome Section -->
    <div class="mb-8">
        <div
            class="bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 rounded-2xl shadow-xl p-8 text-white relative overflow-hidden">
            <!-- Decorative elements -->
            <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full -mr-32 -mt-32"></div>
            <div class="absolute bottom-0 left-0 w-48 h-48 bg-white/10 rounded-full -ml-24 -mb-24"></div>

            <div class="relative z-10">
                <h1 class="text-4xl font-bold mb-2">
                    Welcome back, {{ auth()->check() ? auth()->user()->name : 'Guest' }}! 👋
                </h1>
                <p class="text-indigo-100 text-lg">
                    @auth
                        You're logged in as <span class="font-semibold">{{ ucfirst(auth()->user()->role) }}</span>
                    @else
                        Please login to access all features
                    @endauth
                </p>
                @auth
                    <div class="mt-6 flex gap-4 flex-wrap">
                        @can('create', App\Models\Post::class)
                            <a href="/blog/create"
                                class="inline-flex items-center px-6 py-3 bg-white text-indigo-600 font-semibold rounded-lg shadow-md hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-200">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4">
                                    </path>
                                </svg>
                                Create New Post
                            </a>
                        @endcan
                        <a href="/blog"
                            class="inline-flex items-center px-6 py-3 bg-white/20 backdrop-blur-sm text-white font-semibold rounded-lg hover:bg-white/30 transition-all duration-200">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z">
                                </path>
                            </svg>
                            View All Posts
                        </a>
                    </div>
                @else
                    <div class="mt-6 flex gap-4">
                        <a href="/login"
                            class="inline-flex items-center px-6 py-3 bg-white text-indigo-600 font-semibold rounded-lg shadow-md hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-200">
                            Login
                        </a>
                        <a href="/signup"
                            class="inline-flex items-center px-6 py-3 bg-white/20 backdrop-blur-sm text-white font-semibold rounded-lg hover:bg-white/30 transition-all duration-200">
                            Sign Up
                        </a>
                    </div>
                @endauth
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Posts -->
        <div
            class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-blue-500 hover:shadow-xl transition-shadow duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium mb-1">Total Posts</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $stats['total_posts'] }}</p>
                    <p class="text-xs text-gray-400 mt-1">{{ $stats['published_posts'] }} published</p>
                </div>
                <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z">
                        </path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Total Users -->
        <div
            class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-green-500 hover:shadow-xl transition-shadow duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium mb-1">Total Users</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $stats['total_users'] }}</p>
                    <p class="text-xs text-green-600 mt-1">Active community</p>
                </div>
                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                        </path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Total Comments -->
        <div
            class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-purple-500 hover:shadow-xl transition-shadow duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium mb-1">Total Comments</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $stats['total_comments'] }}</p>
                    <p class="text-xs text-gray-400 mt-1">Engagement</p>
                </div>
                <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center">
                    <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                        </path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- My Posts (if authenticated) -->
        @auth
            <div
                class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-indigo-500 hover:shadow-xl transition-shadow duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-medium mb-1">My Posts</p>
                        <p class="text-3xl font-bold text-gray-900">{{ $userStats['my_posts'] ?? 0 }}</p>
                        <p class="text-xs text-gray-400 mt-1">Your contributions</p>
                    </div>
                    <div class="w-16 h-16 bg-indigo-100 rounded-full flex items-center justify-center">
                        <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                </div>
            </div>
        @else
            <div
                class="bg-gradient-to-br from-indigo-50 to-purple-50 rounded-xl shadow-lg p-6 border-2 border-dashed border-indigo-300 flex items-center justify-center">
                <div class="text-center">
                    <svg class="w-12 h-12 text-indigo-400 mx-auto mb-3" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                        </path>
                    </svg>
                    <p class="text-gray-600 font-medium">Login to see your stats</p>
                </div>
            </div>
        @endauth
    </div>

    <!-- Main Content Grid -->
    <div class="grid lg:grid-cols-3 gap-8">
        <!-- Recent Posts -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-2xl font-bold text-gray-900 flex items-center">
                        <svg class="w-6 h-6 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Recent Posts
                    </h2>
                    <a href="/blog" class="text-indigo-600 hover:text-indigo-700 font-medium text-sm flex items-center">
                        View All
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                            </path>
                        </svg>
                    </a>
                </div>

                @if($recentPosts->count() > 0)
                    <div class="space-y-4">
                        @foreach($recentPosts as $post)
                            <div
                                class="flex items-start p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors duration-200 group">
                                <div
                                    class="w-12 h-12 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-lg flex items-center justify-center text-white font-bold text-lg mr-4 flex-shrink-0">
                                    {{ substr($post->title, 0, 1) }}
                                </div>
                                <div class="flex-1 min-w-0">
                                    <a href="/blog/{{ $post->id }}"
                                        class="font-semibold text-gray-900 hover:text-indigo-600 block truncate group-hover:text-indigo-600 transition-colors">
                                        {{ $post->title }}
                                    </a>
                                    <p class="text-sm text-gray-600 mt-1">
                                        By {{ $post->author }}
                                        @if($post->user)
                                            <span class="text-gray-400">•</span>
                                            <span
                                                class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-{{ $post->user->role === 'admin' ? 'green' : ($post->user->role === 'editor' ? 'blue' : 'gray') }}-100 text-{{ $post->user->role === 'admin' ? 'green' : ($post->user->role === 'editor' ? 'blue' : 'gray') }}-800">
                                                {{ ucfirst($post->user->role) }}
                                            </span>
                                        @endif
                                    </p>
                                    <p class="text-xs text-gray-400 mt-1">{{ $post->created_at->diffForHumans() }}</p>
                                </div>
                                <a href="/blog/{{ $post->id }}"
                                    class="ml-4 text-gray-400 hover:text-indigo-600 transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                                        </path>
                                    </svg>
                                </a>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-12">
                        <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                        <p class="text-gray-500 font-medium">No posts yet</p>
                        <p class="text-gray-400 text-sm mt-1">Be the first to create a post!</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-1 space-y-6">
            <!-- Quick Actions -->
            @auth
                <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100">
                    <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                        Quick Actions
                    </h3>
                    <div class="space-y-3">
                        @can('create', App\Models\Post::class)
                            <a href="/blog/create"
                                class="flex items-center p-3 bg-indigo-50 hover:bg-indigo-100 rounded-lg transition-colors group">
                                <div class="w-10 h-10 bg-indigo-600 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4v16m8-8H4"></path>
                                    </svg>
                                </div>
                                <span class="font-medium text-gray-900 group-hover:text-indigo-600">Create Post</span>
                            </a>
                        @endcan

                        <a href="/blog"
                            class="flex items-center p-3 bg-blue-50 hover:bg-blue-100 rounded-lg transition-colors group">
                            <div class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center mr-3">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z">
                                    </path>
                                </svg>
                            </div>
                            <span class="font-medium text-gray-900 group-hover:text-blue-600">View Posts</span>
                        </a>

                        <a href="/about"
                            class="flex items-center p-3 bg-purple-50 hover:bg-purple-100 rounded-lg transition-colors group">
                            <div class="w-10 h-10 bg-purple-600 rounded-lg flex items-center justify-center mr-3">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <span class="font-medium text-gray-900 group-hover:text-purple-600">About Us</span>
                        </a>

                        <a href="/contact"
                            class="flex items-center p-3 bg-green-50 hover:bg-green-100 rounded-lg transition-colors group">
                            <div class="w-10 h-10 bg-green-600 rounded-lg flex items-center justify-center mr-3">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                    </path>
                                </svg>
                            </div>
                            <span class="font-medium text-gray-900 group-hover:text-green-600">Contact Us</span>
                        </a>
                    </div>
                </div>
            @endauth

            <!-- Role Information -->
            @auth
                <div class="bg-gradient-to-br from-indigo-600 to-purple-600 rounded-2xl shadow-lg p-6 text-white">
                    <h3 class="text-lg font-bold mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        Your Role
                    </h3>
                    <div class="bg-white/20 backdrop-blur-sm rounded-lg p-4 mb-4">
                        <p class="text-2xl font-bold">{{ ucfirst(auth()->user()->role) }}</p>
                        <p class="text-indigo-100 text-sm mt-1">{{ auth()->user()->email }}</p>
                    </div>
                    <div class="space-y-2 text-sm">
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-2 {{ auth()->user()->isAdmin() || auth()->user()->isEditor() ? 'text-green-300' : 'text-red-300' }}"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="{{ auth()->user()->isAdmin() || auth()->user()->isEditor() ? 'M5 13l4 4L19 7' : 'M6 18L18 6M6 6l12 12' }}">
                                </path>
                            </svg>
                            <span class="text-indigo-100">Create Posts</span>
                        </div>
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-2 text-green-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                                </path>
                            </svg>
                            <span class="text-indigo-100">View All Posts</span>
                        </div>
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-2 {{ auth()->user()->isAdmin() || auth()->user()->isEditor() ? 'text-green-300' : 'text-red-300' }}"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="{{ auth()->user()->isAdmin() || auth()->user()->isEditor() ? 'M5 13l4 4L19 7' : 'M6 18L18 6M6 6l12 12' }}">
                                </path>
                            </svg>
                            <span class="text-indigo-100">Edit Own Posts</span>
                        </div>
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-2 {{ auth()->user()->isAdmin() ? 'text-green-300' : 'text-red-300' }}"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="{{ auth()->user()->isAdmin() ? 'M5 13l4 4L19 7' : 'M6 18L18 6M6 6l12 12' }}"></path>
                            </svg>
                            <span class="text-indigo-100">Edit Any Post</span>
                        </div>
                    </div>
                </div>
            @else
                <!-- Guest Call to Action -->
                <div class="bg-gradient-to-br from-blue-600 to-indigo-600 rounded-2xl shadow-lg p-6 text-white text-center">
                    <svg class="w-16 h-16 mx-auto mb-4 text-white/80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                    </svg>
                    <h3 class="text-xl font-bold mb-2">Join Our Community</h3>
                    <p class="text-blue-100 mb-4 text-sm">Create an account to start posting and engaging with content</p>
                    <a href="/signup"
                        class="inline-block bg-white text-indigo-600 font-semibold px-6 py-3 rounded-lg hover:bg-blue-50 transition-colors">
                        Sign Up Now
                    </a>
                </div>
            @endauth

            <!-- Platform Stats -->
            <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100">
                <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                        </path>
                    </svg>
                    Platform Stats
                </h3>
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <span class="text-gray-600 text-sm">Posts</span>
                        <div class="flex items-center">
                            <div class="w-24 h-2 bg-gray-200 rounded-full mr-3">
                                <div class="h-2 bg-blue-500 rounded-full"
                                    style="width: {{ min(($stats['total_posts'] / 100) * 100, 100) }}%"></div>
                            </div>
                            <span class="font-semibold text-gray-900">{{ $stats['total_posts'] }}</span>
                        </div>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-gray-600 text-sm">Users</span>
                        <div class="flex items-center">
                            <div class="w-24 h-2 bg-gray-200 rounded-full mr-3">
                                <div class="h-2 bg-green-500 rounded-full"
                                    style="width: {{ min(($stats['total_users'] / 50) * 100, 100) }}%"></div>
                            </div>
                            <span class="font-semibold text-gray-900">{{ $stats['total_users'] }}</span>
                        </div>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-gray-600 text-sm">Comments</span>
                        <div class="flex items-center">
                            <div class="w-24 h-2 bg-gray-200 rounded-full mr-3">
                                <div class="h-2 bg-purple-500 rounded-full"
                                    style="width: {{ min(($stats['total_comments'] / 200) * 100, 100) }}%"></div>
                            </div>
                            <span class="font-semibold text-gray-900">{{ $stats['total_comments'] }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>