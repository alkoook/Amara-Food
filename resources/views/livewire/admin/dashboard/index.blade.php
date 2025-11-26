<div>
    <h1 class="text-3xl font-extrabold text-gray-900 mb-6">ملخص لوحة التحكم</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- إجمالي المنتجات -->
        <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-100">
            <div class="flex items-center justify-between">
                <p class="text-sm font-medium text-gray-500">إجمالي المنتجات</p>
                <svg class="w-6 h-6 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                </svg>
            </div>
            <p class="text-3xl font-bold text-gray-900 mt-1">{{ $products->count() }}</p>
        </div>

        <!-- إجمالي الأصناف -->
        <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-100">
            <div class="flex items-center justify-between">
                <p class="text-sm font-medium text-gray-500">إجمالي الأصناف</p>
                <svg class="w-6 h-6 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                </svg>
            </div>
            <p class="text-3xl font-bold text-gray-900 mt-1">{{ $categories->count() }}</p>
        </div>

        <!-- إجمالي الشركات -->
        <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-100">
            <div class="flex items-center justify-between">
                <p class="text-sm font-medium text-gray-500">إجمالي الشركات</p>
                <svg class="w-6 h-6 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
            </div>
            <p class="text-3xl font-bold text-gray-900 mt-1">{{ $brands->count() }}</p>
        </div>
    </div>

 <div class="mt-8 bg-white p-6 rounded-xl shadow-lg border border-gray-100">
    <h2 class="text-xl font-semibold text-red-700 mb-4 border-b pb-2">
        منتجات ستنتهي مدة صلاحيتها قريباً
    </h2>

    @if($expiringProducts && $expiringProducts->count() > 0)
        <ul class="divide-y divide-gray-100">
            @foreach($expiringProducts->take(10) as $product)
                @php
                    $daysRemaining = \Carbon\Carbon::parse($product->expiry_date)
                                        ->startOfDay()
                                        ->diffInDays(\Carbon\Carbon::now()->startOfDay(), false);

                    if ($daysRemaining > 0) {
                        $textColor = 'text-gray-500 italic'; // منتهي
                        $displayText = 'انتهت منذ ' . abs($daysRemaining) . ' أيام';
                    } elseif ($daysRemaining === 0) {
                        $textColor = 'text-red-600 font-extrabold';
                        $displayText = 'اليوم';
                    } elseif ($daysRemaining <= 7) {
                        $textColor = 'text-red-600 font-extrabold'; // قريب جدًا
                        $displayText = 'باقي ' . $daysRemaining . ' أيام';
                    } elseif ($daysRemaining <= 30) {
                        $textColor = 'text-amber-600 font-semibold'; // قريب
                        $displayText = 'باقي ' . $daysRemaining . ' أيام';
                    } else {
                        $textColor = 'text-gray-700'; // بعيد
                        $displayText = 'باقي ' . $daysRemaining . ' أيام';
                    }
                @endphp
                <li class="flex justify-between items-center py-2 hover:bg-red-50 rounded-md px-2 transition duration-150">
                    <a href="{{ route('admin.products.edit', $product->id) }}" class="text-gray-800 font-medium truncate hover:text-red-700 transition">
                        {{ $product->name }}
                    </a>
                    <span class="text-sm {{ $textColor }} flex-shrink-0 ms-4 text-left min-w-[120px]">
                        {{ $displayText }}
                    </span>
                </li>
            @endforeach
        </ul>
    @else
        <p class="text-gray-500 text-sm py-2">لا توجد منتجات قريبة من تاريخ الانتهاء حالياً.</p>
    @endif
</div>

</div>
