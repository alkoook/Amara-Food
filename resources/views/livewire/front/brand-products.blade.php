<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <nav class="mb-6 text-sm">
            <a href="{{ route('home') }}" class="text-blue-600 hover:text-blue-800">{{ __('Home') }}</a>
            <span class="mx-2 text-gray-400">/</span>
            <a href="{{ route('brands.index') }}" class="text-blue-600 hover:text-blue-800">{{ __('Brands') }}</a>
            <span class="mx-2 text-gray-400">/</span>
            <span class="text-gray-600">{{ $brand->name }}</span>
        </nav>

        <div class="mb-8 flex items-center gap-6">
            @if($brand->logo)
                <img src="{{ asset('storage/' . $brand->logo) }}" 
                     alt="{{ $brand->name }}" 
                     class="w-24 h-24 object-contain">
            @endif
            <div>
                <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $brand->name }}</h1>
                @if($brand->description)
                    <p class="text-gray-600">{{ $brand->description }}</p>
                @endif
            </div>
        </div>

        <!-- Filters -->
        <div class="bg-white rounded-lg shadow-sm p-6 mb-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <input type="text" wire:model.live="search" placeholder="{{ __('Search') }}..." 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>
                <div>
                    <select wire:model.live="categoryFilter" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">{{ __('All Categories') }} </option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <select wire:model.live="sortBy" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="added_date">{{ __('Latest') }}</option>
                        <option value="name">{{ __('Name') }}</option>
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
                                    <span class="text-gray-400">{{ __('No image') }}</span>
                                </div>
                            @endif
                        </div>
                        <div class="p-4">
                            <h3 class="font-bold text-lg text-gray-900 mb-2 group-hover:text-blue-600 transition">
                                {{ $product->name }}
                            </h3>
                            <p class="text-sm text-gray-600 mb-3 line-clamp-2">{{ Str::limit($product->description, 60) }}</p>
                            <div class="flex items-center justify-between text-sm">
                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                    {{ $product->category->name }}
                                </span>
                                @if($product->weight)
                                    <span class="text-gray-700 font-semibold">{{ $product->weight }} {{ __('KG') }}</span>
                                @elseif($product->quantity)
                                    <span class="text-gray-700 font-semibold">{{ $product->quantity }} {{ __('piece') }}</span>
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
                <p class="text-gray-500 text-lg">{{ __('No Products For This Brand') }}</p>
            </div>
        @endif
    </div>

