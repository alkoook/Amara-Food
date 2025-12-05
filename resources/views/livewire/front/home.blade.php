<div>
    <!-- Hero Section (Slider) -->
    <!-- Hero Section (Slider) -->
    <div class="relative w-full bg-gray-900 border-b-4 border-red-600 shadow-2xl overflow-hidden" dir="ltr">
        @if($categories->count() > 0)
            <div x-data="{
                activeSlide: 0,
                totalSlides: {{ $categories->count() }},
                next() {
                    this.activeSlide = (this.activeSlide === this.totalSlides - 1) ? 0 : this.activeSlide + 1;
                },
                prev() {
                    this.activeSlide = (this.activeSlide === 0) ? this.totalSlides - 1 : this.activeSlide - 1;
                },
                startAuto() {
                    setInterval(() => { this.next() }, 6000);
                }
            }"
            x-init="startAuto()"
            class="relative w-full h-[500px] md:h-[650px] group">

                <!-- Slides -->
                <div class="relative w-full h-full">
                    @foreach($categories as $index => $category)
                        <div class="absolute inset-0 w-full h-full transition-opacity duration-1000 ease-in-out"
                             x-show="activeSlide === {{ $index }}"
                             x-transition:enter="transition ease-out duration-1000"
                             x-transition:enter-start="opacity-0 transform scale-105"
                             x-transition:enter-end="opacity-100 transform scale-100"
                             x-transition:leave="transition ease-in duration-1000"
                             x-transition:leave-start="opacity-100 transform scale-100"
                             x-transition:leave-end="opacity-0 transform scale-95">

                            <!-- Image -->
                            @if($category->image)
                                <img src="{{ asset('storage/' . $category->image) }}"
                                     alt="{{ $category->name }}"
                                     class="w-full h-full object-cover filter brightness-50">
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-gray-800 to-black flex items-center justify-center">
                                    <span class="text-white text-6xl font-black opacity-20">AMARA FOOD</span>
                                </div>
                            @endif

                            <!-- Content Overlay -->
                            <div class="absolute inset-0 flex flex-col items-center justify-center text-center px-4 z-10">
                                <h1 class="text-6xl md:text-8xl font-black text-white mb-6 drop-shadow-[0_5px_5px_rgba(0,0,0,0.8)] tracking-tighter animate-slide-up">
                                    {{ $category->name }}
                                </h1>

                                <a href="{{ route('categories.show', $category->id) }}"
                                   class="px-10 py-4 bg-red-600 text-white text-xl font-bold rounded-full shadow-lg hover:bg-red-700 hover:shadow-red-600/50 transition-all duration-300 transform hover:-translate-y-1 hover:scale-105 animate-bounce-in">
                                    {{ __('Discover Now') }}
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Navigation Buttons -->
                <button @click="prev()" class="absolute left-4 top-1/2 -translate-y-1/2 bg-white/10 backdrop-blur-md text-white p-4 rounded-full hover:bg-red-600 transition-all duration-300 hover:scale-110 focus:outline-none group-hover:opacity-100 opacity-0">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                </button>
                <button @click="next()" class="absolute right-4 top-1/2 -translate-y-1/2 bg-white/10 backdrop-blur-md text-white p-4 rounded-full hover:bg-red-600 transition-all duration-300 hover:scale-110 focus:outline-none group-hover:opacity-100 opacity-0">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </button>
{{-- 
                <!-- Indicators -->
                <div class="absolute bottom-8 left-1/2 -translate-x-1/2 flex space-x-3 space-x-reverse z-20">
                    @foreach($categories as $index => $cat)
                        <button @click="activeSlide = {{ $index }}"
                                class="w-3 h-3 rounded-full transition-all duration-300"
                                :class="activeSlide === {{ $index }} ? 'bg-red-600 w-8' : 'bg-white/50 hover:bg-white'"></button>
                    @endforeach
                </div> --}}
            </div>
        @else
            <div class="h-[500px] flex flex-col items-center justify-center bg-gray-900 text-white">
                <h1 class="text-4xl font-bold mb-4">{{ __('Welcome to AmaraFood') }}</h1>
                <p class="text-gray-400">{{ __('No offers currently available.') }}</p>
            </div>
        @endif
    </div>

    <style>
        @keyframes slide-up {
            0% { opacity: 0; transform: translateY(30px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        .animate-slide-up { animation: slide-up 0.8s ease-out forwards; }

        @keyframes fade-in-delayed {
            0% { opacity: 0; }
            50% { opacity: 0; }
            100% { opacity: 1; }
        }
        .animate-fade-in-delayed { animation: fade-in-delayed 1.2s ease-out forwards; }

        @keyframes bounce-in {
            0% { opacity: 0; transform: scale(0.3); }
            50% { opacity: 1; transform: scale(1.05); }
            70% { transform: scale(0.9); }
            100% { transform: scale(1); }
        }
        .animate-bounce-in { animation: bounce-in 1s cubic-bezier(0.215, 0.610, 0.355, 1.000) both; }
    </style>


    <!-- Partners / Brands Section (Poetic & Circular) -->
    <!-- Partners / Brands Strip (Slim & Elegant) -->
    @if(isset($partners) && $partners->count() > 0)
        <div class="relative w-full bg-white border-b border-gray-100 overflow-hidden py-4 shadow-sm">
            <div class="flex items-center">
                <!-- Optional Label -->
                <div class="hidden md:flex items-center px-6 border-r border-gray-100 z-20 bg-white relative">
                    <span class="text-gray-500 text-sm font-bold uppercase tracking-widest whitespace-nowrap">{{ __('Our Partners') }}</span>
                </div>

                <!-- Marquee Container -->
                <div class="relative flex-1 overflow-hidden group">
                    <!-- Gradient Masks -->
                    <div class="absolute top-0 left-0 w-16 h-full bg-gradient-to-r from-white to-transparent z-10 pointer-events-none"></div>
                    <div class="absolute top-0 right-0 w-16 h-full bg-gradient-to-l from-white to-transparent z-10 pointer-events-none"></div>

                    <div class="flex animate-marquee-slow whitespace-nowrap items-center">
                        <!-- First Set -->
                        @foreach($partners as $partner)
                            <a href="{{ route('brands.show', $partner->id) }}"
                               class="mx-6 w-16 h-16 flex-shrink-0 relative group/item cursor-pointer block"
                               title="{{ $partner->name }}">
                                <div class="w-full h-full rounded-full border border-gray-100 bg-white flex items-center justify-center p-2 transition-all duration-500 ease-out transform group-hover/item:scale-110 group-hover/item:border-red-200 overflow-hidden">
                                    @if($partner->logo)
                                        <img src="{{ asset('storage/' . $partner->logo) }}"
                                             alt="{{ $partner->name }}"
                                             class="w-full h-full object-contain filter grayscale opacity-70 group-hover/item:grayscale-0 group-hover/item:opacity-100 transition-all duration-500">
                                    @else
                                        <span class="text-gray-400 font-bold text-xl group-hover/item:text-red-600 transition-colors">{{ mb_substr($partner->name, 0, 1) }}</span>
                                    @endif
                                </div>
                            </a>
                        @endforeach

                        <!-- Duplicate Set -->
                        @foreach($partners as $partner)
                             <a href="{{ route('brands.show', $partner->id) }}"
                               class="mx-6 w-16 h-16 flex-shrink-0 relative group/item cursor-pointer block"
                               title="{{ $partner->name }}">
                                <div class="w-full h-full rounded-full border border-gray-100 bg-white flex items-center justify-center p-2 transition-all duration-500 ease-out transform group-hover/item:scale-110 group-hover/item:border-red-200 overflow-hidden">
                                    @if($partner->logo)
                                        <img src="{{ asset('storage/' . $partner->logo) }}"
                                             alt="{{ $partner->name }}"
                                             class="w-full h-full object-contain filter grayscale opacity-70 group-hover/item:grayscale-0 group-hover/item:opacity-100 transition-all duration-500">
                                    @else
                                        <span class="text-gray-400 font-bold text-xl group-hover/item:text-red-600 transition-colors">{{ mb_substr($partner->name, 0, 1) }}</span>
                                    @endif
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <style>
            @keyframes marquee-slow {
                0% { transform: translateX(0); }
                100% { transform: translateX(-50%); }
            }
            .animate-marquee-slow {
                animation: marquee-slow 60s linear infinite;
            }
            .animate-marquee-slow:hover {
                animation-play-state: paused;
            }
            html[dir="rtl"] .animate-marquee-slow {
                animation: marquee-slow-rtl 60s linear infinite;
            }
            @keyframes marquee-slow-rtl {
                0% { transform: translateX(0); }
                100% { transform: translateX(50%); }
            }
        </style>
    @endif

    <!-- Filters and Search -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <!-- تم تعديل خلفية صندوق الفلاتر لتعزيز التباين -->
        <div class="bg-white/90 backdrop-blur-sm rounded-2xl shadow-2xl p-8 mb-10 border-4 border-red-100 transition-shadow duration-500 hover:shadow-red-400/70">
            <h2 class="text-2xl font-extrabold text-gray-800 mb-6 border-b pb-3">{{ __('Explore Our Menu') }}</h2>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <!-- حقل البحث - تم تحويله إلى زر أحمر -->
                <div class="relative">
                    <label for="search" class="sr-only">Search</label>
                    <input type="text" id="search" wire:model.live="search" placeholder="{{ __('Search for a product...') }}"
                            class="w-full px-5 py-3 border-2 border-red-700 rounded-xl transition duration-300 shadow-lg hover:shadow-2xl hover:scale-[1.02] bg-white-600 text-white font-bold placeholder-red-200 focus:bg-black-700 focus:ring-4 focus:ring-white">
                </div>

                <div class="relative">
                    <label for="categoryFilter" class="sr-only">Category</label>
                    <select id="categoryFilter" wire:model.live="categoryFilter"
                            class="w-full px-5 py-3 border-2 border-red-700 rounded-xl transition duration-300 shadow-lg hover:shadow-2xl hover:scale-[1.02] bg-red-600 text-white font-bold focus:bg-red-700 focus:ring-4 focus:ring-white appearance-none">
                        <option value="" class="bg-white text-gray-800">{{ __('All Categories') }}</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" class="bg-white text-gray-800">{{ $category->name }}</option>
                        @endforeach
                    </select>

                </div>

                <!-- حقل تصفية العلامة التجارية - تم تحويله إلى زر أحمر -->
                <div class="relative">
                    <label for="brandFilter" class="sr-only">Brand</label>
                    <select id="brandFilter" wire:model.live="brandFilter"
                            class="w-full px-5 py-3 border-2 border-red-700 rounded-xl transition duration-300 shadow-lg hover:shadow-2xl hover:scale-[1.02] bg-red-600 text-white font-bold focus:bg-red-700 focus:ring-4 focus:ring-white appearance-none">
                        <option value="" class="bg-white text-gray-800">{{ __('All Brands') }}</option>
                        @foreach($brands as $brand)
                            <option value="{{ $brand->id }}" class="bg-white text-gray-800">{{ $brand->name }}</option>
                        @endforeach
                    </select>
                    <!-- أيقونة سهم مخصصة لـ Select -->
                </div>

                <!-- حقل الفرز - تم تحويله إلى زر أحمر -->
                <div class="relative">
                    <label for="sortBy" class="sr-only">Sort By</label>
                    <select id="sortBy" wire:model.live="sortBy"
                            class="w-full px-5 py-3 border-2 border-red-700 rounded-xl transition duration-300 shadow-lg hover:shadow-2xl hover:scale-[1.02] bg-red-600 text-white font-bold focus:bg-red-700 focus:ring-4 focus:ring-white appearance-none">
                        <option value="added_date" class="bg-white text-gray-800">{{ __('Latest') }}</option>
                        <option value="name" class="bg-white text-gray-800">{{ __('Name') }}</option>
                    </select>

                </div>
            </div>
        </div>

        <!-- Products Grid -->
        <!-- Products Grid -->
        <div class="mb-16">
            @if($products->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                    @foreach($products as $product)
                        <div class="group relative bg-white rounded-3xl shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 overflow-hidden border border-gray-100">

                            <!-- Image Container -->
                            <div class="relative h-64 overflow-hidden bg-gray-100">
                                <a href="{{ route('products.show', $product->id) }}">
                                    @if($product->image)
                                        <img src="{{ asset('storage/' . $product->image) }}"
                                             alt="{{ $product->name }}"
                                             class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700 linear">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center bg-gray-50">
                                            <svg class="w-16 h-16 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        </div>
                                    @endif
                                </a>

                                <!-- Category Badge -->
                                <div class="absolute top-4 left-4 z-10">
                                    <span class="px-3 py-1 bg-white/90 backdrop-blur-sm text-red-600 text-xs font-extrabold uppercase tracking-wider rounded-lg shadow-sm">
                                        {{ $product->category->name }}
                                    </span>
                                </div>

                                <!-- Quick Action Overlay -->
                                <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                    <a href="{{ route('products.show', $product->id) }}" class="px-6 py-2 bg-white text-red-600 font-bold rounded-full transform scale-75 group-hover:scale-100 transition-transform duration-300 hover:bg-red-50">
                                        {{ __('View Details') }}
                                    </a>
                                </div>
                            </div>

                            <!-- Content -->
                            <div class="p-6">
                                <div class="flex justify-between items-start mb-2">
                                    <h3 class="text-xl font-bold text-gray-900 group-hover:text-red-600 transition-colors line-clamp-1">
                                        <a href="{{ route('products.show', $product->id) }}">{{ $product->name }}</a>
                                    </h3>
                                </div>

                                <p class="text-gray-500 text-sm mb-4 line-clamp-2 h-10">{{ Str::limit($product->description, 80) }}</p>

                                <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                                    <div class="flex items-center gap-2">
                                        <div class="w-6 h-6 rounded-full bg-gray-100 flex items-center justify-center text-gray-400">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                                        </div>
                                        <span class="text-sm font-semibold text-gray-600">{{ $product->brand->name }}</span>
                                    </div>

                                    @if($product->weight || $product->quantity)
                                        <div class="text-right">
                                            <span class="block text-xs text-gray-400">{{ __('Size') }}</span>
                                            <span class="text-red-600 font-bold">
{{ $product->weight ? $product->weight . 'g' : '' }}
{{ $product->quantity ? ' x (' . $product->quantity . ')' : '' }}
                                            </span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-12 flex justify-center">
                    {{ $products->links() }}
                </div>
            @else
                <div class="bg-white rounded-2xl shadow-xl p-16 text-center border-4 border-red-200/50">
                    <p class="text-red-500 text-2xl font-bold">{{ __('No products available matching filters.') }}</p>
                    <p class="text-gray-500 mt-2">{{ __('Try adjusting your search or filters.') }}</p>
                </div>
            @endif
        </div>
    </div>


</div>
