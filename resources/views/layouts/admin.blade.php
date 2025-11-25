<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'لوحة التحكم' }} - AmaraFood</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="bg-gray-950 text-gray-100">
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-gray-900 text-white min-h-screen">
            <div class="p-6">
                <h1 class="text-2xl font-bold text-center">AmaraFood</h1>
                <p class="text-gray-400 text-sm text-center mt-2">لوحة التحكم</p>
            </div>
            <nav class="mt-8">
                <a href="{{ route('admin.dashboard') }}" class="block px-6 py-3 hover:bg-gray-800 {{ request()->routeIs('admin.dashboard') ? 'bg-gray-800 border-r-4 border-blue-500' : '' }}">
                    الرئيسية
                </a>
                <a href="{{ route('admin.categories.index') }}" class="block px-6 py-3 hover:bg-gray-800 {{ request()->routeIs('admin.categories.*') ? 'bg-gray-800 border-r-4 border-blue-500' : '' }}">
                    الأصناف
                </a>
                <a href="{{ route('admin.brands.index') }}" class="block px-6 py-3 hover:bg-gray-800 {{ request()->routeIs('admin.brands.*') ? 'bg-gray-800 border-r-4 border-blue-500' : '' }}">
                    الشركات
                </a>
                <a href="{{ route('admin.products.index') }}" class="block px-6 py-3 hover:bg-gray-800 {{ request()->routeIs('admin.products.*') ? 'bg-gray-800 border-r-4 border-blue-500' : '' }}">
                    المنتجات
                </a>
                <a href="{{ route('admin.settings.index') }}" class="block px-6 py-3 hover:bg-gray-800 {{ request()->routeIs('admin.settings.*') ? 'bg-gray-800 border-r-4 border-blue-500' : '' }}">
                    الإعدادات
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 bg-gray-900">
            <header class="bg-gray-900 border-b border-gray-800">
                <div class="px-6 py-4 flex items-center justify-between">
                    <h2 class="text-xl font-semibold text-gray-100">{{ $title ?? 'لوحة التحكم' }}</h2>
                    <div class="text-sm text-gray-400">
                        {{ auth()->user()->name ?? 'Admin' }}
                    </div>
                </div>
            </header>
            
            <div class="p-6">
                @if (session()->has('message'))
                    <div class="mb-4 bg-emerald-900/40 border border-emerald-500 text-emerald-200 px-4 py-3 rounded relative" role="alert">
                        <span class="block sm:inline">{{ session('message') }}</span>
                    </div>
                @endif

                {{ $slot }}
            </div>
        </main>
    </div>
    @livewireScripts
</body>
</html>
