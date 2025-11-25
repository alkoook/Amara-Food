@props(['title' => 'لوحة التحكم'])

<!DOCTYPE html>
<html lang="ar" dir="rtl" class="h-full bg-white">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title }} - Amara Food</title>

    <!-- Google Fonts: Cairo -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Scripts & Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{-- <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script> --}}
    @livewireStyles

    <style>
        body { font-family: 'Cairo', sans-serif; }
        [x-cloak] { display: none !important; }
        /* Custom Scrollbar styling for light theme */
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: #f1f5f9; /* Slate-100 */ }
        ::-webkit-scrollbar-thumb { background: #94a3b8; /* Slate-400 */ border-radius: 3px; }
        ::-webkit-scrollbar-thumb:hover { background: #64748b; /* Slate-500 */ }
    </style>
</head>
<body class="h-full text-gray-800 antialiased selection:bg-red-500 selection:text-white" x-data="{ sidebarOpen: false }">

    <div class="min-h-screen flex bg-white">

        <!-- Mobile Sidebar Overlay -->
        <div x-show="sidebarOpen"
            x-transition:enter="transition-opacity ease-linear duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition-opacity ease-linear duration-300"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 bg-gray-900/40 backdrop-blur-sm z-40 lg:hidden"
            @click="sidebarOpen = false"
            x-cloak></div>

        <!-- Sidebar (White/Light) -->
        <aside :class="sidebarOpen ? 'translate-x-0' : 'translate-x-full lg:translate-x-0'"
            class="fixed lg:static inset-y-0 right-0 z-50 w-72 bg-white border-l border-gray-200 transform transition-transform duration-300 ease-in-out lg:transform-none flex flex-col shadow-xl lg:shadow-none">

            <!-- Logo Area -->
            <div class="flex items-center justify-center h-20 bg-white border-b border-gray-200 shadow-sm">
                <div class="flex items-center gap-3">
                <div class="flex items-center justify-center h-20 bg-white border-b border-gray-200 shadow-sm">

                    <div class="flex items-center gap-3">
                            <img src="{{ asset('logo.png') }}" alt="Amara Food Logo"
                                class="h-20 w-20 object-contain rounded">
                        </div>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold text-gray-800 tracking-wide">Amara Food</h1>
                        <p class="text-[10px] text-red-600 uppercase tracking-widest font-semibold">لوحة التحكم</p>
                    </div>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 px-4 py-6 space-y-1 overflow-y-auto">
                <p class="px-4 text-xs font-semibold text-gray-500 uppercase tracking-wider mb-3">القائمة الرئيسية</p>

                <!-- Dashboard Link -->
                <a href="{{ route('admin.dashboard') }}"
                class="flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 group {{ request()->routeIs('admin.dashboard') ? 'bg-red-600 text-white shadow-lg shadow-red-500/30' : 'text-gray-700 hover:bg-red-50 hover:text-red-700' }}">
                    <svg class="w-5 h-5 ml-3 transition-colors {{ request()->routeIs('admin.dashboard') ? 'text-white' : 'text-gray-400 group-hover:text-red-600' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                    </svg>
                    الرئيسية
                </a>

                <!-- Categories Link -->
                <a href="{{ route('admin.categories.index') }}"
                class="flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 group {{ request()->routeIs('admin.categories.*') ? 'bg-red-600 text-white shadow-lg shadow-red-500/30' : 'text-gray-700 hover:bg-red-50 hover:text-red-700' }}">
                    <svg class="w-5 h-5 ml-3 transition-colors {{ request()->routeIs('admin.categories') ? 'text-white' : 'text-gray-400 group-hover:text-red-600' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                    </svg>
                    الأصناف
                </a>

                <!-- Brands Link -->
                <a href="{{ route('admin.brands.index') }}"
                class="flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 group {{ request()->routeIs('admin.brands.*') ? 'bg-red-600 text-white shadow-lg shadow-red-500/30' : 'text-gray-700 hover:bg-red-50 hover:text-red-700' }}">
                    <svg class="w-5 h-5 ml-3 transition-colors {{ request()->routeIs('admin.brands.*') ? 'text-white' : 'text-gray-400 group-hover:text-red-600' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                    </svg>
                    الشركات
                </a>

                <!-- Products Link -->
                <a href="{{ route('admin.products.index') }}"
                class="flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 group {{ request()->routeIs('admin.products.*') ? 'bg-red-600 text-white shadow-lg shadow-red-500/30' : 'text-gray-700 hover:bg-red-50 hover:text-red-700' }}">
                    <svg class="w-5 h-5 ml-3 transition-colors {{ request()->routeIs('admin.products.*') ? 'text-white' : 'text-gray-400 group-hover:text-red-600' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                    المنتجات
                </a>

                <div class="border-t border-gray-200 my-4 mx-2"></div>
                <p class="px-4 text-xs font-semibold text-gray-500 uppercase tracking-wider mb-3">الإعدادات</p>

                <!-- Settings Link -->
                <a href="{{ route('admin.settings.index') }}"
                class="flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 group {{ request()->routeIs('admin.settings.*') ? 'bg-red-600 text-white shadow-lg shadow-red-500/30' : 'text-gray-700 hover:bg-red-50 hover:text-red-700' }}">
                    <svg class="w-5 h-5 ml-3 transition-colors {{ request()->routeIs('admin.settings.*') ? 'text-white' : 'text-gray-400 group-hover:text-red-600' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    إعدادات النظام
                </a>
            </nav>

            <!-- User Info Footer -->
            <div class="p-4 bg-gray-100 border-t border-gray-200">
                <div class="flex items-center gap-3">
                    <img class="h-9 w-9 rounded-full object-cover ring-2 ring-red-500" src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name ?? 'Admin') }}&background=f87171&color=fff" alt="User avatar">
                    <div class="flex flex-col">
                        <span class="text-sm font-medium text-gray-800 truncate w-32">{{ auth()->user()->name ?? 'مدير النظام' }}</span>
                        <span class="text-xs text-red-600 font-medium">متصل</span>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 flex flex-col min-w-0 overflow-hidden bg-gray-50">
            <!-- Header (White/Light) -->
            <header class="sticky top-0 z-20 bg-white/95 backdrop-blur-md border-b border-gray-200 h-20">
                <div class="flex items-center justify-between px-6 h-full">

                    <!-- Mobile Trigger -->
                    <button @click="sidebarOpen = true" class="lg:hidden text-gray-500 hover:text-red-600 p-2 rounded-md hover:bg-gray-100 transition-colors">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>

                    <!-- Title -->
                    <h2 class="text-xl font-bold text-gray-800 flex items-center gap-3">
                        <span class="w-1.5 h-6 bg-red-500 rounded-full hidden sm:block"></span>
                        {{ $title }}
                    </h2>

                    <!-- Top Right Actions -->
                    <div class="flex items-center gap-4">
                        <!-- Notification Bell (Example) -->
                        <button class="text-gray-500 hover:text-red-600 transition-colors relative">
                            <span class="absolute top-0 right-0 w-2 h-2 bg-red-500 rounded-full ring-2 ring-white"></span>
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                            </svg>
                        </button>

                        <!-- User Dropdown -->
                        <div x-data="{ open: false }" class="relative">
                            <button @click="open = !open" @click.away="open = false" class="flex items-center gap-2 text-sm text-gray-700 hover:text-red-600 transition-colors focus:outline-none">
                                <span class="hidden md:block">{{ auth()->user()->name ?? 'Admin' }}</span>
                                <svg class="w-4 h-4 text-gray-500" :class="{'rotate-180': open}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>

                            <!-- Dropdown Menu -->
                            <div x-show="open"
                                x-transition:enter="transition ease-out duration-100"
                                x-transition:enter-start="transform opacity-0 scale-95"
                                x-transition:enter-end="transform opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-75"
                                class="absolute left-0 mt-2 w-48 bg-white border border-gray-200 rounded-lg shadow-xl py-1 z-50 origin-top-left" x-cloak>
                                <form method="POST" action="{{ route('admin.logout') }}">
                                    @csrf
                                    <button wire:click="logout" class="block w-full text-right px-4 py-2 text-sm text-red-600 hover:bg-red-50 hover:text-red-700 transition-colors">
                                        تسجيل خروج
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Content Body -->
            <div class="p-6 overflow-y-auto h-full">
                <div class="max-w-7xl mx-auto">
                    <!-- Flash Message -->
                    @if (session()->has('message'))
                        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
                            x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 -translate-y-2"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-300"
                            x-transition:leave-end="opacity-0 -translate-y-2"
                            class="mb-6 flex items-center p-4 rounded-xl bg-emerald-500/10 border border-emerald-500/30 text-emerald-600 shadow-sm" role="alert">
                            <svg class="w-5 h-5 ml-3 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span class="text-sm font-medium">{{ session('message') }}</span>
                            <button @click="show = false" class="mr-auto text-emerald-500/60 hover:text-emerald-400">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                            </button>
                        </div>
                    @endif

                    <!-- Page Content -->
                    <div class="animate-fade-in-up">
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </main>
    </div>

    @livewireScripts
</body>
</html>
