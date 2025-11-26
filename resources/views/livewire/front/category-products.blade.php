<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <nav class="mb-6 text-sm">
            <a href="{{ route('home') }}" class="text-blue-600 hover:text-blue-800">الرئيسية</a>
            <span class="mx-2 text-gray-400">/</span>
            <a href="{{ route('categories.index') }}" class="text-blue-600 hover:text-blue-800">الأصناف</a>
            <span class="mx-2 text-gray-400">/</span>
            <span class="text-gray-600">{{ $category->name }}</span>
        </nav>

        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-4">{{ $category->name }}</h1>
            @if($category->description)
                <p class="text-gray-600">{{ $category->description }}</p>
            @endif
        </div>

        <!-- Filters -->
        <div class="bg-white rounded-lg shadow-sm p-6 mb-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <input type="text" wire:model.live="search" placeholder="بحث عن منتج..."
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
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
                <p class="text-gray-500 text-lg">لا توجد منتجات في هذا الصنف</p>
            </div>
        @endif
    </div>

