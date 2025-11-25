<!DOCTYPE html>
<html lang="ar" dir="rtl" class="h-full bg-slate-900">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>{{ $title ?? 'لوحة التحكم' }} - AmaraFood</title>

    <!-- Google Fonts: Cairo for professional Arabic UI -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Scripts & Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Alpine.js (If not included in your app.js) -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    @livewireStyles
    
    <style>
        body { font-family: 'Cairo', sans-serif; }
        [x-cloak] { display: none !important; }
        /* Custom Scrollbar */
        ::-webkit-scrollbar { width: 8px; height: 8px; }
        ::-webkit-scrollbar-track { background: #0f172a; }
        ::-webkit-scrollbar-thumb { background: #334155; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #475569; }
    </style>
</head>
<body class="h-full text-slate-200 antialiased" x-data="{ sidebarOpen: false, profileOpen: false }">

    <div class="min-h-screen flex bg-slate-900">
        
        <!-- Mobile Sidebar Overlay -->
        <div x-show="sidebarOpen" x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-slate-900/80 z-40 lg:hidden" @click="sidebarOpen = false" x-cloak></div>

        <!-- Sidebar -->
        <!-- Fixed sidebar for mobile, static for desktop -->
        <aside :class="sidebarOpen ? 'translate-x-0' : 'translate-x-full lg:translate-x-0'" class="fixed lg:static inset-y-0 right-0 z-50 w-72 bg-slate-800 border-l border-slate-700/50 transform transition-transform duration-300 ease-in-out lg:transform-none flex flex-col shadow-2xl lg:shadow-none">
            
            <!-- Logo Section -->
            <div class="flex items-center justify-center h-20 bg-slate-800/50 border-b border-slate-700/50 shadow-sm">
                <div class="flex items-center space-x-3 space-x-reverse">
                    <!-- Simple Logo Icon -->
                    <div class="bg-indigo-600 p-2 rounded-lg shadow-lg shadow-indigo-500/20">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold text-white tracking-wide">Amara<span class="text-indigo-400">Food</span></h1>
                        <p class="text-xs text-slate-400">لوحة تحكم الإدارة</p>
                    </div>
                </div>
            </div>

            <!-- Navigation Links -->
            <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
                
                <p class="px-4 text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">القائمة الرئيسية</p>

                <!-- Dashboard Link -->
                <a href="{{ route('admin.dashboard') }}" 
                   class="flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 group {{ request()->routeIs('admin.dashboard') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-500/20' : 'text-slate-300 hover:bg-slate-700/50 hover:text-white' }}">
                    <svg class="w-5 h-5 ml-3 {{ request()->routeIs('admin.dashboard') ? 'text-white' : 'text-slate-400 group-hover:text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                    الرئيسية
                </a>

                <!-- Categories -->
                <a href="{{ route('admin.categories.index') }}" 
                   class="flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 group {{ request()->routeIs('admin.categories.*') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-500/20' : 'text-slate-300 hover:bg-slate-700/50 hover:text-white' }}">
                    <svg class="w-5 h-5 ml-3 {{ request()->routeIs('admin.categories.*') ? 'text-white' : 'text-slate-400 group-hover:text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                    الأصناف
                </a>

                <!-- Brands -->
                <a href="{{ route('admin.brands.index') }}" 
                   class="flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 group {{ request()->routeIs('admin.brands.*') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-500/20' : 'text-slate-300 hover:bg-slate-700/50 hover:text-white' }}">
                    <svg class="w-5 h-5 ml-3 {{ request()->routeIs('admin.brands.*') ? 'text-white' : 'text-slate-400 group-hover:text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                    الشركات
                </a>

                <!-- Products -->
                <a href="{{ route('admin.products.index') }}" 
                   class="flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 group {{ request()->routeIs('admin.products.*') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-500/20' : 'text-slate-300 hover:bg-slate-700/50 hover:text-white' }}">
                    <svg class="w-5 h-5 ml-3 {{ request()->routeIs('admin.products.*') ? 'text-white' : 'text-slate-400 group-hover:text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                    المنتجات
                </a>

                <div class="border-t border-slate-700/50 my-4"></div>
                <p class="px-4 text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">النظام</p>

                <!-- Settings -->
                <a href="{{ route('admin.settings.index') }}" 
                   class="flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 group {{ request()->routeIs('admin.settings.*') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-500/20' : 'text-slate-300 hover:bg-slate-700/50 hover:text-white' }}">
                    <svg class="w-5 h-5 ml-3 {{ request()->routeIs('admin.settings.*') ? 'text-white' : 'text-slate-400 group-hover:text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    الإعدادات
                </a>

            </nav>
            
            <!-- User Footer in Sidebar -->
            <div class="p-4 bg-slate-800 border-t border-slate-700/50">
                <div class="flex items-center gap-3">
                    <img class="h-9 w-9 rounded-full object-cover border-2 border-slate-600" src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name ?? 'Admin') }}&background=6366f1&color=fff" alt="User avatar">
                    <div class="flex flex-col">
                        <span class="text-sm font-medium text-white">{{ auth()->user()->name ?? 'مدير النظام' }}</span>
                        <span class="text-xs text-slate-400">مسؤول</span>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Main Content Wrapper -->
        <div class="flex-1 flex flex-col min-w-0 overflow-hidden">
            
            <!-- Top Header -->
            <header class="bg-slate-900/80 backdrop-blur-md border-b border-slate-800 sticky top-0 z-30">
                <div class="flex items-center justify-between px-6 py-3 h-20">
                    
                    <!-- Mobile Menu Button -->
                    <button @click="sidebarOpen = true" class="lg:hidden text-slate-400 hover:text-white focus:outline-none">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    </button>

                    <!-- Page Title -->
                    <h2 class="text-xl font-bold text-slate-100 flex items-center gap-2">
                        <span class="hidden sm:inline-block w-2 h-8 bg-indigo-500 rounded-full mr-2"></span>
                        {{ $title ?? 'لوحة التحكم' }}
                    </h2>

                    <!-- Header Actions -->
                    <div class="flex items-center gap-4">
                        
                        <!-- Notifications Bell (Static Example) -->
                        <button class="relative p-2 text-slate-400 hover:text-indigo-400 transition-colors">
                            <span class="absolute top-2 left-2 w-2 h-2 bg-red-500 rounded-full"></span>
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                        </button>

                        <!-- Profile Dropdown -->
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" @click.away="open = false" class="flex items-center gap-2 focus:outline-none">
                                <span class="hidden md:block text-sm font-medium text-slate-300 hover:text-white transition-colors">{{ auth()->user()->name ?? 'Admin' }}</span>
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" :class="{'rotate-180': open}"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            </button>
                            
                            <!-- Dropdown Menu -->
                            <div x-show="open" 
                                 x-transition:enter="transition ease-out duration-100"
                                 x-transition:enter-start="transform opacity-0 scale-95"
                                 x-transition:enter-end="transform opacity-100 scale-100"
                                 x-transition:leave="transition ease-in duration-75"
                                 x-transition:leave-start="transform opacity-100 scale-100"
                                 x-transition:leave-end="transform opacity-0 scale-95"
                                 class="absolute left-0 mt-2 w-48 bg-slate-800 rounded-lg shadow-xl border border-slate-700 py-1 z-50 origin-top-left" x-cloak>
                                
                                <a href="#" class="block px-4 py-2 text-sm text-slate-300 hover:bg-slate-700 hover:text-white transition-colors">الملف الشخصي</a>
                                <a href="#" class="block px-4 py-2 text-sm text-slate-300 hover:bg-slate-700 hover:text-white transition-colors">الإعدادات</a>
                                <div class="border-t border-slate-700 my-1"></div>
                          
                            </div>
                        </div>

                    </div>
                </div>
            </header>
            
            <!-- Main Content Area -->
            <main class="flex-1 overflow-y-auto bg-slate-900 p-6">
                <div class="max-w-7xl mx-auto">
                    
                    <!-- Flash Messages -->
                    @if (session()->has('message'))
                        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)" 
                             x-transition:enter="transition ease-out duration-300"
                             x-transition:enter-start="opacity-0 transform translate-y-2"
                             x-transition:enter-end="opacity-100 transform translate-y-0"
                             x-transition:leave="transition ease-in duration-300"
                             x-transition:leave-start="opacity-100 transform translate-y-0"
                             x-transition:leave-end="opacity-0 transform translate-y-2"
                             class="mb-6 bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 px-4 py-4 rounded-xl shadow-lg flex items-center justify-between" role="alert">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                <span class="font-medium">{{ session('message') }}</span>
                            </div>
                            <button @click="show = false" class="text-emerald-400 hover:text-emerald-300"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg></button>
                        </div>
                    @endif

                    <!-- Content Slot (Make sure it's uncommented) -->
                    <div class="animate-fade-in-up">
                       @yield('content')
                    </div>
                </div>
            </main>
        </div>
    </div>
    
    @livewireScripts
</body>
</html> 