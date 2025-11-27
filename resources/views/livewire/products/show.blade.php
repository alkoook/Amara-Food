<div>
<div class="mb-6">
        <a href="{{ route('admin.products.index') }}" class="text-blue-600 hover:text-blue-800">
            ← العودة إلى قائمة المنتجات
        </a>
    </div>

    <div class="bg-white rounded-lg shadow-sm p-6 max-w-4xl">
        <div class="flex justify-between items-start mb-6">
            <h3 class="text-2xl font-bold text-gray-800">تفاصيل المنتج</h3>
            <a href="{{ route('admin.products.edit', $product->id) }}"
               class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                تعديل
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                         class="w-40 h-40 cover rounded-lg">
                @else
                    <div class="w-full h-64 bg-gray-200 rounded-lg flex items-center justify-center">
                        <span class="text-gray-400">لا توجد صورة</span>
                    </div>
                @endif
            </div>

            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">اسم المنتج</label>
                    <p class="text-lg font-semibold text-gray-900">{{ $product->name }}</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">الصنف</label>
                    <span class="px-3 py-1 text-sm font-semibold rounded-full bg-green-100 text-green-800">
                        {{ $product->category->name }}
                    </span>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">الشركة</label>
                    <span class="px-3 py-1 text-sm font-semibold rounded-full bg-purple-100 text-purple-800">
                        {{ $product->brand->name }}
                    </span>
                </div>

                @if($product->weight)
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">الوزن</label>
                        <p class="text-gray-900">{{ $product->weight }} كجم</p>
                    </div>
                @endif

                @if($product->quantity)
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">الكمية</label>
                        <p class="text-gray-900">{{ $product->quantity }} قطعة</p>
                    </div>
                @endif

                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">تاريخ الإضافة</label>
                    <p class="text-gray-900">{{ $product->added_date->format('Y-m-d') }}</p>
                </div>

        
            </div>
        </div>

        <div class="mt-6">
            <label class="block text-sm font-medium text-gray-500 mb-2">الوصف</label>
            <p class="text-gray-900 whitespace-pre-wrap">{{ $product->description }}</p>
        </div>
    </div>

</div>
