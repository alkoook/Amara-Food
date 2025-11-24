<!-- Hero Section -->
    <div class="bg-gradient-to-l from-blue-600 to-indigo-700 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">مرحباً بكم في AmaraFood</h1>
            <p class="text-xl md:text-2xl text-blue-100">أفضل المنتجات الغذائية بجودة عالية</p>
        </div>
    </div>

    <!-- Filters and Search -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white rounded-lg shadow-sm p-6 mb-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <input type="text" wire:model.live="search" placeholder="بحث عن منتج..." 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>
                <div>
                    <select wire:model.live="categoryFilter" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">جميع الأصناف</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <select wire:model.live="brandFilter" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">جميع الشركات</option>
                        @foreach($brands as $brand)
                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <select wire:model.live="sortBy" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="added_date">الأحدث</option>
                        <option value="name">الاسم</option>
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
                           class="bg-white rounded-lg shadow-sm hover:shadow-lg transition-shadow overflow-hidden group">
                            <div class="relative overflow-hidden">
                                @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" 
                                         alt="{{ $product->name }}" 
                                         class="w-full h-48 object-cover group-hover:scale-110 transition-transform duration-300">
                                @else
                                    <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                                        <span class="text-gray-400">لا توجد صورة</span>
                                    </div>
                                @endif
                                <div class="absolute top-2 left-2">
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-600 text-white">
                                        {{ $product->category->name }}
                                    </span>
                                </div>
                            </div>
                            <div class="p-4">
                                <h3 class="font-bold text-lg text-gray-900 mb-2 group-hover:text-blue-600 transition">
                                    {{ $product->name }}
                                </h3>
                                <p class="text-sm text-gray-600 mb-3 line-clamp-2">{{ Str::limit($product->description, 60) }}</p>
                                <div class="flex items-center justify-between text-sm">
                                    <span class="text-gray-500">{{ $product->brand->name }}</span>
                                    @if($product->weight)
                                        <span class="text-gray-700 font-semibold">{{ $product->weight }} كجم</span>
                                    @elseif($product->quantity)
                                        <span class="text-gray-700 font-semibold">{{ $product->quantity }} قطعة</span>
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
                <div class="bg-white rounded-lg shadow-sm p-12 text-center">
                    <p class="text-gray-500 text-lg">لا توجد منتجات متاحة</p>
                </div>
            @endif
        </div>
    </div>

