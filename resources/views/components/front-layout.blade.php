@props(['title' => 'AmaraFood'])

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }} - AmaraFood</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="bg-gray-50 font-cairo"> <!-- يفضل استخدام font-cairo اذا كنت ضايف الخط -->
    <!-- Header -->
    <header class="bg-white shadow-sm sticky top-0 z-50 border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-4">
                <div class="flex items-center">
                    <!-- Logo Red -->
                    <a href="{{ route('home') }}" class="text-2xl font-extrabold text-red-600 tracking-tight hover:text-red-700 transition-colors">
                        Amara<span class="text-gray-800">Food</span>
                    </a>
                </div>
                <nav class="hidden md:flex space-x-reverse space-x-8 items-center">
                    @guest
                        <a href="{{ route('home') }}" class="text-gray-600 hover:text-red-600 transition-colors {{ request()->routeIs('home') ? 'text-red-600 font-bold' : '' }}">الرئيسية</a>
                        <a href="{{ route('products.index') }}" class="text-gray-600 hover:text-red-600 transition-colors {{ request()->routeIs('products.*') ? 'text-red-600 font-bold' : '' }}">المنتجات</a>
                        <a href="{{ route('categories.index') }}" class="text-gray-600 hover:text-red-600 transition-colors {{ request()->routeIs('categories.*') ? 'text-red-600 font-bold' : '' }}">الأصناف</a>
                        <a href="{{ route('brands.index') }}" class="text-gray-600 hover:text-red-600 transition-colors {{ request()->routeIs('brands.*') ? 'text-red-600 font-bold' : '' }}">الشركات</a>
                        <a href="{{ route('about') }}" class="text-gray-600 hover:text-red-600 transition-colors {{ request()->routeIs('about') ? 'text-red-600 font-bold' : '' }}">من نحن</a>
                        <a href="{{ route('contact') }}" class="text-gray-600 hover:text-red-600 transition-colors {{ request()->routeIs('contact') ? 'text-red-600 font-bold' : '' }}">تواصل معنا</a>

                        <!-- Login Button Styled -->
                        <a href="{{ route('login') }}" class="px-4 py-2 bg-red-600 text-white rounded-lg font-semibold hover:bg-red-700 transition-colors shadow-sm hover:shadow">
                            دخول الآدمن
                        </a>
                    @else
                        <a href="{{ route('admin.dashboard') }}" class="text-red-600 font-semibold hover:text-red-800 transition-colors flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                            لوحة تحكم الآدمن
                        </a>
                    @endguest
                </nav>
                @guest
                    <button class="md:hidden text-gray-700 hover:text-red-600 transition-colors" id="mobile-menu-button">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                @else
                    <a href="{{ route('admin.dashboard') }}" class="md:hidden text-red-600 font-semibold">
                        لوحة التحكم
                    </a>
                @endguest
            </div>
        </div>
        @guest
            <!-- Mobile Menu -->
            <div class="md:hidden hidden bg-white border-t border-gray-100" id="mobile-menu">
                <div class="px-4 py-3 space-y-1">
                    <a href="{{ route('home') }}" class="block py-2 px-3 rounded-md text-gray-700 hover:text-red-600 hover:bg-red-50 transition-colors {{ request()->routeIs('home') ? 'text-red-600 bg-red-50 font-semibold' : '' }}">الرئيسية</a>
                    <a href="{{ route('products.index') }}" class="block py-2 px-3 rounded-md text-gray-700 hover:text-red-600 hover:bg-red-50 transition-colors {{ request()->routeIs('products.*') ? 'text-red-600 bg-red-50 font-semibold' : '' }}">المنتجات</a>
                    <a href="{{ route('categories.index') }}" class="block py-2 px-3 rounded-md text-gray-700 hover:text-red-600 hover:bg-red-50 transition-colors {{ request()->routeIs('categories.*') ? 'text-red-600 bg-red-50 font-semibold' : '' }}">الأصناف</a>
                    <a href="{{ route('brands.index') }}" class="block py-2 px-3 rounded-md text-gray-700 hover:text-red-600 hover:bg-red-50 transition-colors {{ request()->routeIs('brands.*') ? 'text-red-600 bg-red-50 font-semibold' : '' }}">الشركات</a>
                    <a href="{{ route('about') }}" class="block py-2 px-3 rounded-md text-gray-700 hover:text-red-600 hover:bg-red-50 transition-colors {{ request()->routeIs('about') ? 'text-red-600 bg-red-50 font-semibold' : '' }}">من نحن</a>
                    <a href="{{ route('contact') }}" class="block py-2 px-3 rounded-md text-gray-700 hover:text-red-600 hover:bg-red-50 transition-colors {{ request()->routeIs('contact') ? 'text-red-600 bg-red-50 font-semibold' : '' }}">تواصل معنا</a>
                    <div class="border-t border-gray-100 my-2"></div>
                    <a href="{{ route('login') }}" class="block py-2 px-3 rounded-md text-red-600 font-semibold hover:bg-red-50 transition-colors">دخول الآدمن</a>
                </div>
            </div>
        @endguest
    </header>

    <!-- Main Content -->
    <main>
        {{ $slot }}
    </main>

    <!-- Footer -->
    <x-footer />

    @livewireScripts
    @guest
        <script>
            document.getElementById('mobile-menu-button')?.addEventListener('click', function() {
                const menu = document.getElementById('mobile-menu');
                menu.classList.toggle('hidden');
            });
        </script>
    @endguest
</body>
</html>
