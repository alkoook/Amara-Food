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

        /* 1. تأثير النبض (Pulse Effect) للزر الأحمر الرئيسي */
        @keyframes pulse-red {
            0%, 100% {
                box-shadow: 0 0 0 0 rgba(220, 38, 38, 0.7); /* red-600 */
            }
            50% {
                box-shadow: 0 0 0 10px rgba(220, 38, 38, 0);
            }
        }

        /* 2. حركة ظهور الهيدر (Slide Down) */
        @keyframes slideDown {
            from {
                transform: translateY(-100%);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .animated-header {
            animation: slideDown 0.6s ease-out forwards;
        }

        /* 3. تطبيق نمط الأزرار الحمراء */
        .red-button {
            background-color: #dc2626; /* red-600 */
            transition: all 0.3s ease-in-out;
            box-shadow: 0 6px 15px rgba(220, 38, 38, 0.3);
            border: 2px solid transparent;
        }
        .red-button:hover {
            background-color: #b91c1c; /* red-700 */
            transform: translateY(-3px) scale(1.02);
            box-shadow: 0 12px 20px rgba(220, 38, 38, 0.5);
        }

        /* 4. تطبيق النبض على زر التحميل */
        .download-button-pulse {
            animation: pulse-red 2.5s infinite cubic-bezier(0.4, 0, 0.6, 1);
        }

        /* 5. انتقال قائمة الجوال (لتسهيل إضافة max-height في JavaScript) */
        .mobile-menu-transition {
            transition: max-height 0.4s ease-in-out, opacity 0.4s ease-in-out;
            max-height: 0;
            overflow: hidden;
            opacity: 0;
        }
        .mobile-menu-transition.open {
             opacity: 1;
        }
    </style>
</head>
<body class="bg-gray-50 font-cairo"> <!-- يفضل استخدام font-cairo اذا كنت ضايف الخط -->
    <!-- Header: أضفنا animated-header لتطبيق حركة الظهور -->
    <header class="bg-white shadow-lg sticky top-0 z-50 border-b border-red-100 animated-header">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-3">

       <!-- Left: Logo -->
<div class="flex-shrink-0 flex items-center">
    <a href="{{ route('home') }}"
       class="block transform hover:scale-105 transition-transform duration-300">
        <img src="{{ asset('logo.jpg') }}"
             alt="AmaraFood Logo"
             class="w-44 h-22 object-cover rounded-full shadow-md">
    </a>
</div>


                <!-- Center: Navigation Buttons (Desktop) -->
                <nav class="hidden md:flex items-center gap-3">
                    @guest
                        @php
                            $navItems = [
                                ['route' => 'home', 'label' => __('Home')],
                                ['route' => 'products.index', 'label' => __('Products'), 'active' => 'products.*'],
                                ['route' => 'categories.index', 'label' => __('Categories'), 'active' => 'categories.*'],
                                ['route' => 'brands.index', 'label' => __('Brands'), 'active' => 'brands.*'],
                                ['route' => 'about', 'label' => __('About Us')],
                                ['route' => 'contact', 'label' => __('Contact Us')],
                            ];
                        @endphp

                        @foreach($navItems as $item)
                            @php
                                $isActive = request()->routeIs($item['active'] ?? $item['route']);
                            @endphp
                            <a href="{{ route($item['route']) }}"
                               class="px-5 py-2.5 rounded-lg font-bold text-base transition-all duration-300 shadow-sm border-2
                                      {{ $isActive
                                          ? 'bg-white text-red-600 border-red-600'
                                          : 'bg-red-600 text-white border-transparent hover:bg-red-700'
                                      }}">
                                {{ $item['label'] }}
                            </a>
                        @endforeach
                    @else
                        <a href="{{ route('admin.dashboard') }}" class="bg-red-600 text-white px-5 py-2.5 rounded-lg font-bold hover:bg-red-700 transition">
                            {{ __('Admin Dashboard') }}
                        </a>
                    @endguest
                </nav>

                <!-- Right: Language & Download (Desktop) -->
                <div class="hidden md:flex items-center gap-4">
                    <!-- Language Switcher -->
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="flex items-center text-gray-700 hover:text-red-600 font-bold transition-colors">
                            <span>{{ app()->getLocale() == 'ar' ? 'العربية' : 'English' }}</span>
                            <svg class="w-4 h-4 mx-1 transform transition-transform duration-200" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <div x-show="open" @click.away="open = false" class="absolute top-full {{ app()->getLocale() == 'ar' ? 'left-0' : 'right-0' }} mt-2 w-32 bg-white rounded-lg shadow-xl py-1 z-50 border border-gray-100" style="display: none;">
                            <a href="{{ route('switch-language', 'ar') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-red-50 hover:text-red-600 transition-colors">العربية</a>
                            <a href="{{ route('switch-language', 'en') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-red-50 hover:text-red-600 transition-colors">English</a>
                        </div>
                    </div>

                    <!-- Download Button -->
                    @guest
                    <a href="{{ asset('files/AMARA.pdf') }}" download class="flex items-center gap-2 px-5 py-2.5 bg-red-600 text-white font-bold rounded-lg hover:bg-red-700 transition shadow-md hover:shadow-lg">
                        <span>PDF</span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                        </svg>
                    </a>
                    @endguest
                </div>

                <!-- Mobile Menu Button -->
                <div class="md:hidden flex items-center gap-4">
                     <!-- Mobile Language Switcher (Simplified) -->
                     <a href="{{ route('switch-language', app()->getLocale() == 'ar' ? 'en' : 'ar') }}" class="text-sm font-bold text-red-600 border border-red-200 px-2 py-1 rounded">
                        {{ app()->getLocale() == 'ar' ? 'EN' : 'AR' }}
                    </a>

                    <button class="text-gray-700 hover:text-red-600 focus:outline-none" id="mobile-menu-button">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div class="md:hidden bg-white border-t border-gray-100 mobile-menu-transition overflow-hidden" id="mobile-menu">
            <div class="px-4 py-4 space-y-3">
                @guest
                    @foreach($navItems as $item)
                        @php
                            $isActive = request()->routeIs($item['active'] ?? $item['route']);
                        @endphp
                        <a href="{{ route($item['route']) }}"
                           class="block w-full text-center px-4 py-3 rounded-lg font-bold text-lg transition-all
                                  {{ $isActive
                                      ? 'bg-white text-red-600 border-2 border-red-600 shadow-sm'
                                      : 'bg-red-600 text-white border-2 border-transparent hover:bg-red-700'
                                  }}">
                            {{ $item['label'] }}
                        </a>
                    @endforeach

                    <div class="pt-2 border-t border-gray-100 mt-2">
                         <a href="{{ asset('files/AMARA.pdf') }}" download class="block w-full text-center px-4 py-3 bg-gray-800 text-white font-bold rounded-lg hover:bg-gray-900 transition">
                            Download PDF
                        </a>
                    </div>
                @else
                    <a href="{{ route('admin.dashboard') }}" class="block w-full text-center px-4 py-3 bg-red-600 text-white font-bold rounded-lg">
                        {{ __('Admin Dashboard') }}
                    </a>
                @endguest
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
    @guest
        <script>
            document.getElementById('mobile-menu-button')?.addEventListener('click', function() {
                const menu = document.getElementById('mobile-menu');
                // إذا كانت القائمة مغلقة
                if (menu.style.maxHeight === '0px' || menu.style.maxHeight === '') {
                    menu.style.maxHeight = menu.scrollHeight + 'px';
                    menu.classList.add('open');
                } else {
                    // إذا كانت القائمة مفتوحة
                    menu.style.maxHeight = '0px';
                    menu.classList.remove('open');
                }
            });
            // لضمان أن maxHeight تبدأ بصفر عند تحميل الصفحة
            document.addEventListener('DOMContentLoaded', () => {
                 const menu = document.getElementById('mobile-menu');
                 if (menu) {
                     menu.style.maxHeight = '0px';
                 }
            });
        </script>
    @endguest
</body>
</html>
