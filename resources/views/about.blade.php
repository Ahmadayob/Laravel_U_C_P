<x-layout :title="$pageTitle">
    <!-- Hero Section -->
    <div
        class="relative overflow-hidden bg-gradient-to-br from-indigo-50 via-white to-purple-50 -mx-4 sm:-mx-6 lg:-mx-8 px-4 sm:px-6 lg:px-8 py-16 mb-12">
        <div class="relative max-w-4xl mx-auto text-center">
            <h1 class="text-5xl font-extrabold text-gray-900 sm:text-6xl mb-6">
                About <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-purple-600">Our
                    Platform</span>
            </h1>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto leading-relaxed">
                Empowering creators and readers through innovative content management and seamless collaboration.
            </p>
        </div>

        <!-- Decorative elements -->
        <div
            class="absolute top-0 left-0 w-72 h-72 bg-purple-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob">
        </div>
        <div
            class="absolute top-0 right-0 w-72 h-72 bg-indigo-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob animation-delay-2000">
        </div>
        <div
            class="absolute bottom-0 left-1/2 w-72 h-72 bg-pink-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob animation-delay-4000">
        </div>
    </div>

    <!-- Mission & Vision Section -->
    <div class="grid md:grid-cols-2 gap-8 mb-16">
        <!-- Mission Card -->
        <div
            class="bg-white rounded-2xl shadow-lg p-8 border border-gray-100 hover:shadow-xl transition-shadow duration-300">
            <div
                class="w-16 h-16 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center mb-6">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                </svg>
            </div>
            <h2 class="text-2xl font-bold text-gray-900 mb-4">Our Mission</h2>
            <p class="text-gray-600 leading-relaxed">
                To provide a powerful, intuitive platform that enables content creators to share their ideas,
                collaborate effectively, and build engaged communities. We believe in democratizing content
                creation and making it accessible to everyone.
            </p>
        </div>

        <!-- Vision Card -->
        <div
            class="bg-white rounded-2xl shadow-lg p-8 border border-gray-100 hover:shadow-xl transition-shadow duration-300">
            <div
                class="w-16 h-16 bg-gradient-to-br from-purple-500 to-pink-600 rounded-xl flex items-center justify-center mb-6">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                    </path>
                </svg>
            </div>
            <h2 class="text-2xl font-bold text-gray-900 mb-4">Our Vision</h2>
            <p class="text-gray-600 leading-relaxed">
                To become the leading platform for content collaboration, where creators of all levels can
                thrive, learn from each other, and produce exceptional content that inspires and educates
                audiences worldwide.
            </p>
        </div>
    </div>

    <!-- Features Section -->
    <div class="mb-16">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">What Makes Us Different</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">
                Our platform combines powerful features with an intuitive interface to deliver the best content
                management experience.
            </p>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
            <!-- Feature 1 -->
            <div class="text-center group">
                <div
                    class="w-20 h-20 bg-gradient-to-br from-blue-100 to-blue-200 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-10 h-10 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                        </path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-3">Role-Based Access</h3>
                <p class="text-gray-600">
                    Secure, granular permissions system that ensures the right people have the right access.
                </p>
            </div>

            <!-- Feature 2 -->
            <div class="text-center group">
                <div
                    class="w-20 h-20 bg-gradient-to-br from-green-100 to-green-200 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                        </path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-3">Collaborative</h3>
                <p class="text-gray-600">
                    Work together seamlessly with team members, editors, and contributors in real-time.
                </p>
            </div>

            <!-- Feature 3 -->
            <div class="text-center group">
                <div
                    class="w-20 h-20 bg-gradient-to-br from-purple-100 to-purple-200 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-10 h-10 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-3">Lightning Fast</h3>
                <p class="text-gray-600">
                    Optimized performance ensures your content loads quickly and your workflow stays smooth.
                </p>
            </div>
        </div>
    </div>

    <!-- Stats Section -->
    <div
        class="bg-gradient-to-r from-indigo-600 to-purple-600 rounded-2xl shadow-xl p-12 mb-16 -mx-4 sm:-mx-6 lg:-mx-8">
        <div class="grid md:grid-cols-4 gap-8 text-center">
            <div>
                <div class="text-4xl font-bold text-white mb-2">1000+</div>
                <div class="text-indigo-100">Active Users</div>
            </div>
            <div>
                <div class="text-4xl font-bold text-white mb-2">5000+</div>
                <div class="text-indigo-100">Posts Published</div>
            </div>
            <div>
                <div class="text-4xl font-bold text-white mb-2">50+</div>
                <div class="text-indigo-100">Contributors</div>
            </div>
            <div>
                <div class="text-4xl font-bold text-white mb-2">99.9%</div>
                <div class="text-indigo-100">Uptime</div>
            </div>
        </div>
    </div>

    <!-- Team Values -->
    <div class="mb-16">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Our Core Values</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">
                These principles guide everything we do and shape how we build our platform.
            </p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div
                class="bg-white rounded-xl shadow-md p-6 border-t-4 border-indigo-500 hover:shadow-lg transition-shadow">
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Innovation</h3>
                <p class="text-gray-600 text-sm">Constantly pushing boundaries to deliver cutting-edge solutions.</p>
            </div>
            <div
                class="bg-white rounded-xl shadow-md p-6 border-t-4 border-purple-500 hover:shadow-lg transition-shadow">
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Quality</h3>
                <p class="text-gray-600 text-sm">Committed to excellence in every feature and interaction.</p>
            </div>
            <div class="bg-white rounded-xl shadow-md p-6 border-t-4 border-pink-500 hover:shadow-lg transition-shadow">
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Community</h3>
                <p class="text-gray-600 text-sm">Building a supportive ecosystem for creators to thrive.</p>
            </div>
            <div class="bg-white rounded-xl shadow-md p-6 border-t-4 border-blue-500 hover:shadow-lg transition-shadow">
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Transparency</h3>
                <p class="text-gray-600 text-sm">Open, honest communication with our users and partners.</p>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="bg-gray-50 rounded-2xl p-12 text-center">
        <h2 class="text-3xl font-bold text-gray-900 mb-4">Ready to Get Started?</h2>
        <p class="text-gray-600 mb-8 max-w-2xl mx-auto">
            Join thousands of creators who are already using our platform to share their stories and build their
            audience.
        </p>
        <div class="flex gap-4 justify-center flex-wrap">
            <a href="/signup"
                class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-semibold rounded-lg shadow-md hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-200">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                </svg>
                Create Account
            </a>
            <a href="/contact"
                class="inline-flex items-center px-6 py-3 bg-white text-gray-700 font-semibold rounded-lg shadow-md hover:shadow-lg border-2 border-gray-200 hover:border-indigo-300 transform hover:-translate-y-0.5 transition-all duration-200">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                    </path>
                </svg>
                Contact Us
            </a>
        </div>
    </div>

    <style>
        @keyframes blob {

            0%,
            100% {
                transform: translate(0, 0) scale(1);
            }

            33% {
                transform: translate(30px, -50px) scale(1.1);
            }

            66% {
                transform: translate(-20px, 20px) scale(0.9);
            }
        }

        .animate-blob {
            animation: blob 7s infinite;
        }

        .animation-delay-2000 {
            animation-delay: 2s;
        }

        .animation-delay-4000 {
            animation-delay: 4s;
        }
    </style>
</x-layout>