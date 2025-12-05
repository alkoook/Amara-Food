<x-front-layout title="About Us">
    <div class="relative overflow-hidden bg-white">
        <!-- Decorative Background -->
        <div class="absolute top-0 left-0 w-full h-full overflow-hidden pointer-events-none">
            <div class="absolute top-[-10%] left-[-10%] w-96 h-96 bg-red-50 rounded-full mix-blend-multiply filter blur-3xl opacity-70 animate-blob"></div>
            <div class="absolute top-[-10%] right-[-10%] w-96 h-96 bg-orange-50 rounded-full mix-blend-multiply filter blur-3xl opacity-70 animate-blob animation-delay-2000"></div>
            <div class="absolute bottom-[-10%] left-[20%] w-96 h-96 bg-pink-50 rounded-full mix-blend-multiply filter blur-3xl opacity-70 animate-blob animation-delay-4000"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 relative z-10">
            <!-- Header Section -->
            <div class="text-center mb-16">
                <h1 class="text-5xl font-black text-gray-900 mb-6 tracking-tight animate-fade-in-up">
                    {{ __('About') }} <span class="text-red-600">{{ __('AmaraFood') }}</span>
                </h1>
                <div class="w-24 h-1.5 bg-red-600 mx-auto rounded-full mb-8 animate-scale-x"></div>
                {{-- <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed animate-fade-in-up animation-delay-300">
                    {{ __('Discover our story, our values, and our commitment to bringing the finest food products to your table.') }}
                </p> --}}
            </div>

            <!-- Content Section -->
            <div class="bg-white/80 backdrop-blur-md rounded-3xl shadow-xl p-8 md:p-12 border border-gray-100 transform hover:shadow-2xl transition-all duration-500 animate-fade-in-up animation-delay-500">
                @php
                    $companyOverview = \App\Models\Setting::getValue('company_overview', '');
                @endphp

                @if($companyOverview)
                    <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed">
                        {!! nl2br(e($companyOverview)) !!}
                    </div>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                        <div class="space-y-6 text-lg text-gray-700 leading-relaxed">
                            <p class="animate-slide-in-left">
                                {!! __('Welcome to <strong>AmaraFood</strong>, a leading food company in the United Kingdom.') !!}
                            </p>
                            <p class="animate-slide-in-left animation-delay-200">
                                {!! __('We offer a wide range of high-quality food products that meet the needs of our customers. We always strive to provide the best services and products that ensure your satisfaction.') !!}
                            </p>
                            <p class="animate-slide-in-left animation-delay-400">
                                {!! __('Our vision is to be the first choice for our customers in the food sector by offering high-quality products and excellent customer service.') !!}
                            </p>
                            <div class="bg-red-50 border-l-4 border-red-600 p-6 rounded-r-xl animate-slide-in-left animation-delay-600">
                                <p class="font-medium text-red-800 italic">
                                    "{!! __('We are committed to high-quality standards and ensure that all our products meet the highest health and food standards.') !!}"
                                </p>
                            </div>
                        </div>

                        <!-- Image/Visual Side -->
                        <div class="relative h-full min-h-[400px] rounded-2xl overflow-hidden shadow-lg group animate-fade-in-right">
                            <div class="absolute inset-0 bg-gradient-to-br from-red-600 to-orange-500 opacity-90"></div>
                            <div class="absolute inset-0 flex flex-col items-center justify-center text-white p-8 text-center">
                                <svg class="w-20 h-20 mb-6 text-white/80" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                                <h3 class="text-3xl font-bold mb-2">{{ __('Quality First') }}</h3>
                                <p class="text-red-100">{{ __('Excellence in every product we deliver.') }}</p>
                            </div>
                            <!-- Decorative Circles -->
                            <div class="absolute -bottom-10 -right-10 w-40 h-40 bg-white/20 rounded-full blur-2xl"></div>
                            <div class="absolute -top-10 -left-10 w-40 h-40 bg-white/20 rounded-full blur-2xl"></div>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Values Section (Optional Addition) -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-16">
                <div class="bg-white p-8 rounded-2xl shadow-lg border-t-4 border-red-500 hover:-translate-y-2 transition-transform duration-300">
                    <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center mb-4 text-red-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">{{ __('Premium Quality') }}</h3>
                    <p class="text-gray-600">{{ __('We source only the finest ingredients to ensure superior taste and quality.') }}</p>
                </div>
                <div class="bg-white p-8 rounded-2xl shadow-lg border-t-4 border-orange-500 hover:-translate-y-2 transition-transform duration-300">
                    <div class="w-12 h-12 bg-orange-100 rounded-full flex items-center justify-center mb-4 text-orange-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">{{ __('Fast Delivery') }}</h3>
                    <p class="text-gray-600">{{ __('Efficient logistics network ensuring your products arrive fresh and on time.') }}</p>
                </div>
                <div class="bg-white p-8 rounded-2xl shadow-lg border-t-4 border-green-500 hover:-translate-y-2 transition-transform duration-300">
                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mb-4 text-green-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">{{ __('Customer Satisfaction') }}</h3>
                    <p class="text-gray-600">{{ __('Your satisfaction is our top priority, with dedicated support always ready to help.') }}</p>
                </div>
            </div>
        </div>
    </div>

    <style>
        @keyframes blob {
            0% { transform: translate(0px, 0px) scale(1); }
            33% { transform: translate(30px, -50px) scale(1.1); }
            66% { transform: translate(-20px, 20px) scale(0.9); }
            100% { transform: translate(0px, 0px) scale(1); }
        }
        .animate-blob { animation: blob 10s infinite ease-in-out; }
        .animation-delay-2000 { animation-delay: 2s; }
        .animation-delay-4000 { animation-delay: 4s; }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translate3d(0, 40px, 0); }
            to { opacity: 1; transform: translate3d(0, 0, 0); }
        }
        .animate-fade-in-up { animation: fadeInUp 0.8s ease-out forwards; opacity: 0; }

        @keyframes slideInLeft {
            from { opacity: 0; transform: translate3d(-50px, 0, 0); }
            to { opacity: 1; transform: translate3d(0, 0, 0); }
        }
        .animate-slide-in-left { animation: slideInLeft 0.8s ease-out forwards; opacity: 0; }

        @keyframes fadeInRight {
            from { opacity: 0; transform: translate3d(50px, 0, 0); }
            to { opacity: 1; transform: translate3d(0, 0, 0); }
        }
        .animate-fade-in-right { animation: fadeInRight 0.8s ease-out forwards; opacity: 0; }

        .animation-delay-200 { animation-delay: 0.2s; }
        .animation-delay-300 { animation-delay: 0.3s; }
        .animation-delay-400 { animation-delay: 0.4s; }
        .animation-delay-500 { animation-delay: 0.5s; }
        .animation-delay-600 { animation-delay: 0.6s; }
    </style>
</x-front-layout>

