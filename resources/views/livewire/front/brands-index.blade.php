<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Header Section -->
    <div class="text-center mb-16 relative">
        <h1 class="text-4xl md:text-5xl font-black text-gray-900 mb-4 tracking-tight relative z-10">
            {{ __('Our Premium Brands') }}
        </h1>
        <p class="text-xl text-gray-500 max-w-2xl mx-auto relative z-10">
            {{ __('Discover the finest selection of brands we partner with to bring you quality products.') }}
        </p>
        <!-- Decorative Blob -->
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-64 h-64 bg-red-50 rounded-full mix-blend-multiply filter blur-3xl opacity-70 z-0"></div>
    </div>

    <!-- Search & Filter -->
    <div class="max-w-2xl mx-auto mb-16">
        <div class="relative group">
            <input type="text" wire:model.live="search" placeholder="{{ __('Search for a brand...') }}" 
                   class="w-full px-8 py-4 bg-white border-2 border-gray-100 rounded-full shadow-lg text-lg focus:outline-none focus:border-red-500 focus:ring-4 focus:ring-red-500/10 transition-all duration-300 group-hover:shadow-xl">
            <div class="absolute right-6 top-1/2 -translate-y-1/2 text-gray-400 group-hover:text-red-500 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </div>
        </div>
    </div>

    @if($brands->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            @foreach($brands as $brand)
                <a href="{{ route('brands.show', $brand->id) }}" 
                   class="group relative bg-white rounded-3xl shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 overflow-hidden border border-gray-100 flex flex-col h-full">
                    
                    <!-- Logo Container -->
                    <div class="relative h-56 bg-gradient-to-br from-gray-50 to-white flex items-center justify-center p-8 overflow-hidden group-hover:bg-red-50/30 transition-colors duration-500">
                        <!-- Decorative Circle -->
                        <div class="absolute inset-0 bg-red-500/5 rounded-full scale-0 group-hover:scale-150 transition-transform duration-700 ease-out"></div>
                        
                        @if($brand->logo)
                            <img src="{{ asset('storage/' . $brand->logo) }}" 
                                 alt="{{ $brand->name }}" 
                                 class="max-w-full max-h-full object-contain transform group-hover:scale-110 transition-transform duration-500 relative z-10 filter drop-shadow-sm">
                        @else
                            <div class="w-24 h-24 rounded-full bg-gradient-to-br from-red-500 to-red-600 flex items-center justify-center shadow-lg transform group-hover:rotate-12 transition-transform duration-500">
                                <span class="text-white text-4xl font-black">{{ mb_substr($brand->name, 0, 1) }}</span>
                            </div>
                        @endif
                    </div>

                    <!-- Content -->
                    <div class="p-6 flex-1 flex flex-col text-center relative z-10 bg-white">
                        <h3 class="font-black text-xl text-gray-900 mb-2 group-hover:text-red-600 transition-colors duration-300">
                            {{ $brand->name }}
                        </h3>
                        
                        @if($brand->description)
                            <p class="text-sm text-gray-500 mb-4 line-clamp-2 leading-relaxed">{{ Str::limit($brand->description, 80) }}</p>
                        @endif
                        
                        <div class="mt-auto pt-4 border-t border-gray-50 flex items-center justify-center gap-2 text-sm font-medium text-gray-400 group-hover:text-red-500 transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                            <span>{{ $brand->products_count }} {{ __('Products') }}</span>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>

        <div class="mt-16 flex justify-center">
            {{ $brands->links() }}
        </div>
    @else
        <div class="bg-white rounded-3xl shadow-xl p-16 text-center border-4 border-red-50 max-w-2xl mx-auto">
            <div class="w-24 h-24 bg-red-50 rounded-full flex items-center justify-center mx-auto mb-6 animate-pulse">
                <svg class="w-12 h-12 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
            </div>
            <h3 class="text-2xl font-bold text-gray-900 mb-2">{{ __('No Brands Found') }}</h3>
            <p class="text-gray-500">{{ __('We couldn\'t find any brands matching your search.') }}</p>
        </div>
    @endif
</div>

