<div>
    <!-- Hero Section (Slider) -->
<div class="relative w-full bg-gray-100 border-b border-gray-200" dir="ltr"> <!-- خلفية فاتحة -->
    @if($categories->count() > 0)
        <div x-data="{
                activeSlide: 0,
                totalSlides: {{ $categories->count() }},
                next() {
                    this.activeSlide = (this.activeSlide === this.totalSlides - 1) ? 0 : this.activeSlide + 1;
                },
                startAuto() {
                    setInterval(() => { this.next() }, 3000); // كل 3 ثواني بيقلب
                }
            }"
            x-init="startAuto()"
            class="relative w-full h-[380px] overflow-hidden group">

            <!-- Slides Container -->
            <div class="absolute top-0 left-0 w-full h-full flex transition-transform duration-700 ease-in-out"
                 :style="'transform: translateX(-' + (activeSlide * 100) + '%)'">

                @foreach($categories as $category)
                    <div class="w-full flex-shrink-0 relative h-full bg-red-100"> <!-- خلفية حمراء فاتحة في حالة عدم تحميل الصورة -->
                        <!-- صورة المنتج -->
                        @if($category->image)
                            <img src="{{ asset('storage/' . $category->image) }}"
                                 alt="{{ $category->name }}"
                                 class="w-full h-full cover"> <!-- تم التعديل لـ object-contain لظهور الصورة بالكامل -->
                        @else
                            <!-- لون خلفية في حال عدم وجود صورة -->
                            <div class="w-full h-full bg-red-100 flex items-center justify-center">
                                <span class="text-red-600 text-4xl font-extrabold opacity-40">AmaraFood</span>
                            </div>
                        @endif

                        <!-- طبقة تعتيم خفيفة عشان الكلام يوضح -->
                        <div class="absolute inset-0 bg-black/20"></div>

                        <!-- النص فوق الصورة -->
                        <div class="absolute inset-0 flex flex-col items-center justify-center text-center px-4" dir="rtl">
                            <h1 class="text-4xl md:text-6xl font-bold text-white mb-2 drop-shadow-lg tracking-wider">
                                {{ $category->name }}
                            </h1>
                            <a href="{{ route('categories.show', $category->id) }}" class="mt-4 px-6 py-2 bg-red-600 text-white font-semibold rounded-full shadow-lg hover:bg-red-700 transition duration-300 transform hover:scale-105">
                                {{ __('Discover this category') }}
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- نقاط التوضيح تحت (Dots) -->
            <div class="absolute bottom-5 left-1/2 -translate-x-1/2 flex space-x-2 space-x-reverse z-10">
                <template x-for="i in totalSlides">
                    <button class="w-3 h-3 rounded-full transition-all duration-300 shadow-md"
                            :class="activeSlide === i - 1 ? 'bg-red-600 scale-110' : 'bg-white/70'"></button>
                </template>
            </div>
        </div>
    @else
        <!-- في حال لم يكن هناك منتجات -->
        <div class="h-64 flex items-center justify-center bg-gray-100 border-t border-gray-200 text-gray-700">
            <h1 class="text-3xl font-bold">{{ __('No products currently in main offers') }}</h1>
        </div>
    @endif
</div>

<!-- Filters and Search -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="bg-white rounded-xl shadow-lg p-6 mb-8 border border-gray-100">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <input type="text" wire:model.live="search" placeholder="{{ __('Search for a product...') }}"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500">
            </div>
            <div>
                <select wire:model.live="categoryFilter"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500">
                    <option value="">{{ __('All Categories') }}</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <select wire:model.live="brandFilter"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500">
                    <option value="">{{ __('All Brands') }}</option>
                    @foreach($brands as $brand)
                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <select wire:model.live="sortBy"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500">
                    <option value="added_date">{{ __('Latest') }}</option>
                    <option value="name">{{ __('Name') }}</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Products Grid -->
    <div class="mb-8">
        @if($products->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($products as $product)
                    <a href="{{ route('products.show', $product->id) }}"
                       class="bg-white rounded-xl shadow-lg hover:shadow-xl transition-shadow overflow-hidden group border border-gray-100 hover:border-red-300">
                        <div class="relative overflow-hidden">
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}"
                                     alt="{{ $product->name }}"
                                     class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">
                            @else
                                <div class="w-full h-48 bg-gray-100 flex items-center justify-center">
                                    <span class="text-gray-400">{{ __('No image') }}</span>
                                </div>
                            @endif
                            <!-- شارة الصنف باللون الأحمر -->
                            <div class="absolute top-3 left-3">
                                <span class="px-3 py-1 text-xs font-semibold rounded-full bg-red-600 text-white shadow-md">
                                    {{ $product->category->name }}
                                </span>
                            </div>
                        </div>
                        <div class="p-4">
                            <h3 class="font-bold text-xl text-gray-900 mb-2 group-hover:text-red-600 transition truncate">
                                {{ $product->name }}
                            </h3>
                            <p class="text-sm text-gray-600 mb-3 line-clamp-2">{{ Str::limit($product->description, 60) }}</p>
                            <div class="flex items-center justify-between text-sm pt-2 border-t border-gray-100">
                                <span class="text-gray-500 font-medium text-xs">{{ __('Brand') }}: {{ $product->brand->name }}</span>
                                @if($product->weight)
                                    <span class="text-red-600 font-bold text-base">{{ $product->weight }} {{ __('kg') }}</span>
                                @elseif($product->quantity)
                                    <span class="text-red-600 font-bold text-base">{{ $product->quantity }} {{ __('piece') }}</span>
                                @endif
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>

            <div class="mt-8">
                {{ $products->links() }}
            </div>
        @else
            <div class="bg-white rounded-lg shadow-sm p-12 text-center border border-gray-100">
                <p class="text-gray-500 text-lg">{{ __('No products available matching filters.') }}</p>
            </div>
        @endif
    </div>
</div>

</div>
