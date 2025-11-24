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
<body class="bg-gray-50">
    <!-- Header -->
    <header class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-4">
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="text-2xl font-bold text-blue-600">AmaraFood</a>
                </div>
                <nav class="hidden md:flex space-x-reverse space-x-8">
                    <a href="{{ route('home') }}" class="text-gray-700 hover:text-blue-600 {{ request()->routeIs('home') ? 'text-blue-600 font-semibold' : '' }}">الرئيسية</a>
                    <a href="{{ route('products.index') }}" class="text-gray-700 hover:text-blue-600 {{ request()->routeIs('products.*') ? 'text-blue-600 font-semibold' : '' }}">المنتجات</a>
                    <a href="{{ route('categories.index') }}" class="text-gray-700 hover:text-blue-600 {{ request()->routeIs('categories.*') ? 'text-blue-600 font-semibold' : '' }}">الأصناف</a>
                    <a href="{{ route('brands.index') }}" class="text-gray-700 hover:text-blue-600 {{ request()->routeIs('brands.*') ? 'text-blue-600 font-semibold' : '' }}">الشركات</a>
                    <a href="{{ route('about') }}" class="text-gray-700 hover:text-blue-600 {{ request()->routeIs('about') ? 'text-blue-600 font-semibold' : '' }}">من نحن</a>
                    <a href="{{ route('contact') }}" class="text-gray-700 hover:text-blue-600 {{ request()->routeIs('contact') ? 'text-blue-600 font-semibold' : '' }}">تواصل معنا</a>
                </nav>
                <button class="md:hidden text-gray-700" id="mobile-menu-button">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>
        <!-- Mobile Menu -->
        <div class="md:hidden hidden" id="mobile-menu">
            <div class="px-4 py-2 space-y-2 bg-white border-t">
                <a href="{{ route('home') }}" class="block py-2 text-gray-700 hover:text-blue-600">الرئيسية</a>
                <a href="{{ route('products.index') }}" class="block py-2 text-gray-700 hover:text-blue-600">المنتجات</a>
                <a href="{{ route('categories.index') }}" class="block py-2 text-gray-700 hover:text-blue-600">الأصناف</a>
                <a href="{{ route('brands.index') }}" class="block py-2 text-gray-700 hover:text-blue-600">الشركات</a>
                <a href="{{ route('about') }}" class="block py-2 text-gray-700 hover:text-blue-600">من نحن</a>
                <a href="{{ route('contact') }}" class="block py-2 text-gray-700 hover:text-blue-600">تواصل معنا</a>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main>
        {{ $slot }}
    </main>

    <!-- Footer -->
    <x-footer />

    @livewireScripts
    <script>
        document.getElementById('mobile-menu-button')?.addEventListener('click', function() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });
    </script>
</body>
</html>

