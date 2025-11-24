<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <nav class="mb-6 text-sm">
            <a href="{{ route('home') }}" class="text-blue-600 hover:text-blue-800">الرئيسية</a>
            <span class="mx-2 text-gray-400">/</span>
            <a href="{{ route('categories.show', $product->category->id) }}" class="text-blue-600 hover:text-blue-800">{{ $product->category->name }}</a>
            <span class="mx-2 text-gray-400">/</span>
            <span class="text-gray-600">{{ $product->name }}</span>
        </nav>

        <div class="bg-white rounded-lg shadow-sm p-6 md:p-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Product Image -->
                <div>
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" 
                             alt="{{ $product->name }}" 
                             class="w-full rounded-lg shadow-md">
                    @else
                        <div class="w-full h-96 bg-gray-200 rounded-lg flex items-center justify-center">
                            <span class="text-gray-400">لا توجد صورة</span>
                        </div>
                    @endif
                </div>

                <!-- Product Details -->
                <div>
                    <div class="mb-4">
                        <span class="px-3 py-1 text-sm font-semibold rounded-full bg-blue-100 text-blue-800">
                            {{ $product->category->name }}
                        </span>
                        <span class="mr-2 px-3 py-1 text-sm font-semibold rounded-full bg-purple-100 text-purple-800">
                            {{ $product->brand->name }}
                        </span>
                    </div>

                    <h1 class="text-3xl font-bold text-gray-900 mb-4">{{ $product->name }}</h1>

                    <div class="space-y-4 mb-6">
                        @if($product->weight)
                            <div class="flex items-center">
                                <span class="font-semibold text-gray-700 w-32">الوزن:</span>
                                <span class="text-gray-900">{{ $product->weight }} كجم</span>
                            </div>
                        @endif

                        @if($product->quantity)
                            <div class="flex items-center">
                                <span class="font-semibold text-gray-700 w-32">الكمية:</span>
                                <span class="text-gray-900">{{ $product->quantity }} قطعة</span>
                            </div>
                        @endif

                        <div class="flex items-center">
                            <span class="font-semibold text-gray-700 w-32">تاريخ الإضافة:</span>
                            <span class="text-gray-900">{{ $product->added_date->format('Y-m-d') }}</span>
                        </div>

                        @if($product->expiry_date)
                            <div class="flex items-center">
                                <span class="font-semibold text-gray-700 w-32">تاريخ انتهاء الصلاحية:</span>
                                <span class="text-gray-900">{{ $product->expiry_date->format('Y-m-d') }}</span>
                            </div>
                        @endif
                    </div>

                    <div class="border-t pt-6">
                        <h3 class="font-bold text-lg text-gray-900 mb-3">الوصف</h3>
                        <p class="text-gray-700 leading-relaxed whitespace-pre-wrap">{{ $product->description }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Related Products -->
        <div class="mt-12">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">منتجات مشابهة</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach(\App\Models\Product::where('category_id', $product->category_id)
                    ->where('id', '!=', $product->id)
                    ->limit(4)
                    ->get() as $relatedProduct)
                    <a href="{{ route('products.show', $relatedProduct->id) }}" 
                       class="bg-white rounded-lg shadow-sm hover:shadow-lg transition-shadow overflow-hidden group">
                        <div class="relative overflow-hidden">
                            @if($relatedProduct->image)
                                <img src="{{ asset('storage/' . $relatedProduct->image) }}" 
                                     alt="{{ $relatedProduct->name }}" 
                                     class="w-full h-40 object-cover group-hover:scale-110 transition-transform duration-300">
                            @else
                                <div class="w-full h-40 bg-gray-200 flex items-center justify-center">
                                    <span class="text-gray-400 text-xs">لا توجد صورة</span>
                                </div>
                            @endif
                        </div>
                        <div class="p-4">
                            <h3 class="font-bold text-gray-900 mb-2 group-hover:text-blue-600 transition">
                                {{ $relatedProduct->name }}
                            </h3>
                            <p class="text-sm text-gray-600 line-clamp-2">{{ Str::limit($relatedProduct->description, 50) }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>

