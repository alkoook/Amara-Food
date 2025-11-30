@props(['title' => 'AmaraFood'])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('Dashboard') }} - AmaraFood</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

         <style>
        /* لضمان أن الإطار يملأ الحاوية بالكامل */
        .map-container {
            height: 320px; /* جعل الارتفاع ثابتاً وأصغر (أصغر من 450 بكسل) */
        }
        iframe {
            /* إزالة أي حدود داخلية محتملة */
            border: none !important;
        }
    </style>
</head>
<body class="bg-gray-50 font-cairo"> <!-- يفضل استخدام font-cairo اذا كنت ضايف الخط -->
    <!-- Header -->
    <header class="bg-white shadow-sm sticky top-0 z-50 border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-4">
                <div class="flex items-center">
                    <!-- Logo Red -->
                    <a href="{{ route('home') }}" class="text-2xl font-extrabold text-red-600 tracking-tight hover:text-red-700 transition-colors">
                           <div class="mb-5 transform hover:scale-[1.05] transition-transform duration-300">
            <img src="{{ asset('logo.png') }}" alt="AmaraFood Logo" class="w-20 h-20 object-contain rounded-full shadow-lg border-4 border-red-500/20">
        </div>
                    </a>
                </div>
                <nav class="hidden md:flex space-x-reverse space-x-8 items-center">
                    @guest
                        <a href="{{ route('home') }}" class="text-gray-600 hover:text-red-600 transition-colors {{ request()->routeIs('home') ? 'text-red-600 font-bold' : '' }}" style="padding: 50px">{{ __('Home') }}</a>
                        <a href="{{ route('products.index') }}" class="text-gray-600 hover:text-red-600 transition-colors {{ request()->routeIs('products.*') ? 'text-red-600 font-bold' : '' }}">{{ __('Products') }}</a>
                        <a href="{{ route('categories.index') }}" class="text-gray-600 hover:text-red-600 transition-colors {{ request()->routeIs('categories.*') ? 'text-red-600 font-bold' : '' }}">{{ __('Categories') }}</a>
                        <a href="{{ route('brands.index') }}" class="text-gray-600 hover:text-red-600 transition-colors {{ request()->routeIs('brands.*') ? 'text-red-600 font-bold' : '' }}">{{ __('Brands') }}</a>
                        <a href="{{ route('about') }}" class="text-gray-600 hover:text-red-600 transition-colors {{ request()->routeIs('about') ? 'text-red-600 font-bold' : '' }}">{{ __('About Us') }}</a>
                        <a href="{{ route('contact') }}" class="text-gray-600 hover:text-red-600 transition-colors {{ request()->routeIs('contact') ? 'text-red-600 font-bold' : '' }}">{{ __('Contact Us') }}</a>

                        <!-- Language Switcher -->
                        <div class="relative mx-4" x-data="{ open: false }">
                            <button @click="open = !open" class="flex items-center text-gray-600 hover:text-red-600 focus:outline-none font-semibold">
                                <span class="mx-1">{{ app()->getLocale() == 'ar' ? 'العربية' : 'English' }}</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </button>
                            <div x-show="open" @click.away="open = false" class="absolute top-full mt-2 w-32 bg-white rounded-md shadow-lg py-1 z-50 {{ app()->getLocale() == 'ar' ? 'left-0' : 'right-0' }}" style="display: none;">
                                <a href="{{ route('switch-language', 'ar') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-red-50 hover:text-red-600 text-center">العربية</a>
                                <a href="{{ route('switch-language', 'en') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-red-50 hover:text-red-600 text-center">English</a>
                            </div>
                        </div>

<a 
    href="{{ asset('files/AMARA.pdf') }}" 
    download
    class="inline-flex items-center gap-2 px-4 py-2 bg-red-600 text-white font-semibold rounded-lg shadow hover:bg-red-700 transition"
>
    Download AMARA PDF
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
            d="M4 4v16h16V4H4zm8 12l4-4h-3V8h-2v4H8l4 4z"/>
    </svg>
</a>


                    @else
                        <a href="{{ route('admin.dashboard') }}" class="text-red-600 font-semibold hover:text-red-800 transition-colors flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                            {{ __('Admin Dashboard') }}
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
                        {{ __('Dashboard') }}
                    </a>
                @endguest
            </div>
        </div>
        @guest
            <!-- Mobile Menu -->
            <div class="md:hidden hidden bg-white border-t border-gray-100" id="mobile-menu">
                <div class="px-4 py-3 space-y-1">
                    <a href="{{ route('home') }}" class="block py-2 px-3 rounded-md text-gray-700 hover:text-red-600 hover:bg-red-50 transition-colors {{ request()->routeIs('home') ? 'text-red-600 bg-red-50 font-semibold' : '' }}">{{ __('Home') }}</a>
                    <a href="{{ route('products.index') }}" class="block py-2 px-3 rounded-md text-gray-700 hover:text-red-600 hover:bg-red-50 transition-colors {{ request()->routeIs('products.*') ? 'text-red-600 bg-red-50 font-semibold' : '' }}">{{ __('Products') }}</a>
                    <a href="{{ route('categories.index') }}" class="block py-2 px-3 rounded-md text-gray-700 hover:text-red-600 hover:bg-red-50 transition-colors {{ request()->routeIs('categories.*') ? 'text-red-600 bg-red-50 font-semibold' : '' }}">{{ __('Categories') }}</a>
                    <a href="{{ route('brands.index') }}" class="block py-2 px-3 rounded-md text-gray-700 hover:text-red-600 hover:bg-red-50 transition-colors {{ request()->routeIs('brands.*') ? 'text-red-600 bg-red-50 font-semibold' : '' }}">{{ __('Brands') }}</a>
                    <a href="{{ route('about') }}" class="block py-2 px-3 rounded-md text-gray-700 hover:text-red-600 hover:bg-red-50 transition-colors {{ request()->routeIs('about') ? 'text-red-600 bg-red-50 font-semibold' : '' }}">{{ __('About Us') }}</a>
                    <a href="{{ route('contact') }}" class="block py-2 px-3 rounded-md text-gray-700 hover:text-red-600 hover:bg-red-50 transition-colors {{ request()->routeIs('contact') ? 'text-red-600 bg-red-50 font-semibold' : '' }}">{{ __('Contact Us') }}</a>
                    <div class="border-t border-gray-100 my-2"></div>
                    <div class="px-3 py-2 text-sm font-medium text-gray-500">{{ __('Language') }}</div>
                    <a href="{{ route('switch-language', 'ar') }}" class="block py-2 px-3 rounded-md text-gray-700 hover:text-red-600 hover:bg-red-50 transition-colors">العربية</a>
                    <a href="{{ route('switch-language', 'en') }}" class="block py-2 px-3 rounded-md text-gray-700 hover:text-red-600 hover:bg-red-50 transition-colors">English</a>
                    <div class="border-t border-gray-100 my-2"></div>
                 <a 
    href="{{ asset('files/AMARA.pdf') }}" 
    download
    class="inline-flex items-center gap-2 px-4 py-2 bg-red-600 text-white font-semibold rounded-lg shadow hover:bg-red-700 transition"
>
    Download AMARA PDF
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
            d="M4 4v16h16V4H4zm8 12l4-4h-3V8h-2v4H8l4 4z"/>
    </svg>
</a>

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
