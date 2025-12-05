<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Header Section -->
    <div class="text-center mb-16 relative">
        <h1 class="text-4xl md:text-5xl font-black text-gray-900 mb-4 tracking-tight relative z-10">
            {{ __('Our Products') }}
        </h1>
        <p class="text-xl text-gray-500 max-w-2xl mx-auto relative z-10">
            {{ __('Explore our wide range of premium quality products.') }}
        </p>
        <!-- Decorative Blob -->
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-64 h-64 bg-red-50 rounded-full mix-blend-multiply filter blur-3xl opacity-70 z-0"></div>
    </div>

    <!-- Filters -->
    <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-lg p-6 mb-10 border-2 border-red-50">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <div class="relative">
                <input type="text" wire:model.live="search" placeholder="{{ __('Search products...') }}"
                       class="w-full px-5 py-3 border-2 border-gray-200 rounded-xl focus:border-red-500 focus:ring-4 focus:ring-red-500/10 transition-all outline-none">
                <svg class="w-5 h-5 text-gray-400 absolute right-4 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </div>
            <div class="relative">
                <select wire:model.live="categoryFilter"
                        class="w-full px-5 py-3 border-2 border-gray-200 rounded-xl focus:border-red-500 focus:ring-4 focus:ring-red-500/10 transition-all outline-none appearance-none bg-white">
                    <option value="">{{ __('All Categories') }}</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>

            </div>
            <div class="relative">
                <select wire:model.live="brandFilter"
                        class="w-full px-5 py-3 border-2 border-gray-200 rounded-xl focus:border-red-500 focus:ring-4 focus:ring-red-500/10 transition-all outline-none appearance-none bg-white">
                    <option value="">{{ __('All Brands') }}</option>
                    @foreach($brands as $brand)
                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                    @endforeach
                </select>

            </div>
            <div class="relative">
                <select wire:model.live="sortBy"
                        class="w-full px-5 py-3 border-2 border-gray-200 rounded-xl focus:border-red-500 focus:ring-4 focus:ring-red-500/10 transition-all outline-none appearance-none bg-white">
                    <option value="added_date">{{ __('Latest') }}</option>
                    <option value="name">{{ __('Name') }}</option>
                </select>

            </div>
        </div>
    </div>

    <!-- Products Grid -->
    @if($products->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            @foreach($products as $product)
                <div class="group relative bg-white rounded-3xl shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 overflow-hidden border border-gray-100">

                    <!-- Image Container -->
                    <div class="relative h-64 overflow-hidden bg-gray-100">
                        <a href="{{ route('products.show', $product->id) }}">
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}"
                                     alt="{{ $product->name }}"
                                     class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700 ease-out">
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-gray-50">
                                    <svg class="w-16 h-16 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                            @endif
                        </a>

                        <!-- Badges -->
                        <div class="absolute top-4 left-4 z-10 flex flex-col gap-2">
                            <span class="px-3 py-1 bg-white/90 backdrop-blur-sm text-red-600 text-xs font-extrabold uppercase tracking-wider rounded-lg shadow-sm">
                                {{ $product->category->name }}
                            </span>
                            <span class="px-3 py-1 bg-gray-900/90 backdrop-blur-sm text-white text-xs font-bold uppercase tracking-wider rounded-lg shadow-sm">
                                {{ $product->brand->name }}
                            </span>
                        </div>

                        <!-- Quick Action Overlay -->
                        <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                            <a href="{{ route('products.show', $product->id) }}" class="px-6 py-2 bg-white text-red-600 font-bold rounded-full transform scale-75 group-hover:scale-100 transition-transform duration-300 hover:bg-red-50">
                                {{ __('View Details') }}
                            </a>
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-2">
                            <h3 class="text-xl font-bold text-gray-900 group-hover:text-red-600 transition-colors line-clamp-1">
                                <a href="{{ route('products.show', $product->id) }}">{{ $product->name }}</a>
                            </h3>
                        </div>

                        <p class="text-gray-500 text-sm mb-4 line-clamp-2 h-10">{{ Str::limit($product->description, 80) }}</p>

                        <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                            <div class="flex items-center gap-2">
                                <div class="w-6 h-6 rounded-full bg-gray-100 flex items-center justify-center text-gray-400">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                                </div>
                                <span class="text-sm font-semibold text-gray-600">{{ $product->brand->name }}</span>
                            </div>

                            @if($product->weight || $product->quantity)
                                <div class="text-right">
                                    <span class="block text-xs text-gray-400">{{ __('Size') }}</span>
                                    <span class="text-red-600 font-bold">
                                        {{ $product->weight ?? '' }} {{ $product->quantity ? ($product->weight ? 'x ' : '') . $product->quantity : '' }}
                                    </span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-12 flex justify-center">
            {{ $products->links() }}
        </div>
    @else
        <div class="bg-white rounded-3xl shadow-xl p-16 text-center border-4 border-red-50">
            <div class="w-20 h-20 bg-red-50 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-10 h-10 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
            </div>
            <p class="text-gray-900 text-xl font-bold mb-2">{{ __('No products found') }}</p>
            <p class="text-gray-500">{{ __('Try adjusting your filters or check back later.') }}</p>
        </div>
    @endif
</div>

