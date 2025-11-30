<x-admin-layout title="{{ __('Dashboard') }}">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white rounded-lg shadow-sm p-6">
            <h3 class="text-lg font-semibold mb-2">{{ __('Products') }}</h3>
            <p class="text-gray-600 mb-4">{{ __('Manage and view products.') }}</p>
            <a href="{{ route('admin.products.index') }}" class="text-blue-600 hover:text-blue-800">{{ __('Go to Products →') }}</a>
        </div>
        <div class="bg-white rounded-lg shadow-sm p-6">
            <h3 class="text-lg font-semibold mb-2">{{ __('Categories') }}</h3>
            <p class="text-gray-600 mb-4">{{ __('Organize products into categories.') }}</p>
            <a href="{{ route('admin.categories.index') }}" class="text-blue-600 hover:text-blue-800">{{ __('Go to Categories →') }}</a>
        </div>
        <div class="bg-white rounded-lg shadow-sm p-6">
            <h3 class="text-lg font-semibold mb-2">{{ __('Brands') }}</h3>
            <p class="text-gray-600 mb-4">{{ __('Manage companies and brands.') }}</p>
            <a href="{{ route('admin.brands.index') }}" class="text-blue-600 hover:text-blue-800">{{ __('Go to Brands →') }}</a>
        </div>
    </div>
</x-admin-layout>
