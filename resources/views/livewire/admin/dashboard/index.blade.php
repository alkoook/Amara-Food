<div>
    <h1 class="text-3xl font-extrabold text-gray-900 mb-6">ملخص لوحة التحكم</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

        <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-100">
            <div class="flex items-center justify-between">
                <p class="text-sm font-medium text-gray-500">إجمالي المنتجات</p>
                <svg class="w-6 h-6 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
            </div>
            {{-- افترض أن لديك متغير $totalProducts من المكون --}}
            <p class="text-3xl font-bold text-gray-900 mt-1">{{ number_format($totalProducts ?? 0) }}</p>
            <span class="text-xs text-green-500 font-medium">↑ 12% هذا الشهر</span>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-100">
            <div class="flex items-center justify-between">
                <p class="text-sm font-medium text-gray-500">الأصناف المتاحة</p>
                <svg class="w-6 h-6 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
            </div>
            {{-- افترض أن لديك متغير $totalCategories من المكون --}}
            <p class="text-3xl font-bold text-gray-900 mt-1">{{ $totalCategories ?? 0 }}</p>
            <span class="text-xs text-gray-500 font-medium">لا توجد بيانات جديدة</span>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-100">
            <div class="flex items-center justify-between">
                <p class="text-sm font-medium text-gray-500">الطلبات المعلقة</p>
                <svg class="w-6 h-6 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
            </div>
            {{-- افترض أن لديك متغير $pendingOrders من المكون --}}
            <p class="text-3xl font-bold text-gray-900 mt-1">{{ $pendingOrders ?? 0 }}</p>
            <span class="text-xs text-red-500 font-medium">تحتاج لمعالجة سريعة</span>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-100">
            <div class="flex items-center justify-between">
                <p class="text-sm font-medium text-gray-500">مستخدمون جدد (اليوم)</p>
                <svg class="w-6 h-6 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
            </div>
            {{-- افترض أن لديك متغير $newUsersToday من المكون --}}
            <p class="text-3xl font-bold text-gray-900 mt-1">{{ $newUsersToday ?? 0 }}</p>
            <span class="text-xs text-green-500 font-medium">↑ 30% مقارنة بأمس</span>
        </div>
    </div>

    <div class="mt-8 bg-white p-6 rounded-xl shadow-lg border border-gray-100">
        <h2 class="text-xl font-semibold text-gray-900 mb-4">أكثر المنتجات مبيعاً</h2>
        {{-- هنا يمكنك تضمين جدول Livewire صغير أو رسم بياني --}}
        <p class="text-gray-600">سيتم وضع قائمة بأكثر 5 منتجات مبيعًا هنا.</p>
    </div>

</div>
