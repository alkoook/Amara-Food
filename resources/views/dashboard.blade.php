<x-admin-layout title="لوحة التحكم">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white rounded-lg shadow-sm p-6">
            <h3 class="text-lg font-semibold mb-2">المنتجات</h3>
            <p class="text-gray-600 mb-4">إدارة وعرض المنتجات.</p>
            <a href="{{ route('admin.products.index') }}" class="text-blue-600 hover:text-blue-800">الانتقال للمنتجات →</a>
        </div>
        <div class="bg-white rounded-lg shadow-sm p-6">
            <h3 class="text-lg font-semibold mb-2">الأصناف</h3>
            <p class="text-gray-600 mb-4">تنظيم المنتجات ضمن أصناف.</p>
            <a href="{{ route('admin.categories.index') }}" class="text-blue-600 hover:text-blue-800">الانتقال للأصناف →</a>
        </div>
        <div class="bg-white rounded-lg shadow-sm p-6">
            <h3 class="text-lg font-semibold mb-2">الشركات</h3>
            <p class="text-gray-600 mb-4">إدارة الشركات والعلامات التجارية.</p>
            <a href="{{ route('admin.brands.index') }}" class="text-blue-600 hover:text-blue-800">الانتقال للشركات →</a>
        </div>
    </div>
</x-admin-layout>
