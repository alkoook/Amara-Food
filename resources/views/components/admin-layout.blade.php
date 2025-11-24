@props(['title' => 'لوحة التحكم'])

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
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-gray-900 text-white min-h-screen">
            <div class="p-6">
                <h1 class="text-2xl font-bold text-center">AmaraFood</h1>
                <p class="text-gray-400 text-sm text-center mt-2">لوحة التحكم</p>
            </div>
            <nav class="mt-8">
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
        <main class="flex-1">
            <header class="bg-white shadow-sm border-b">
                <div class="px-6 py-4">
                    <h2 class="text-xl font-semibold text-gray-800">{{ $title }}</h2>
                </div>
            </header>

            <div class="p-6">
                @if (session()->has('message'))
                    <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                        <span class="block sm:inline">{{ session('message') }}</span>
                    </div>
                @endif

{{ $slot ?? '' }}
            </div>
        </main>
    </div>
    @livewireScripts
</body>
</html>

