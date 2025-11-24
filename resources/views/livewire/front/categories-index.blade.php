<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-4">جميع الأصناف</h1>
            <div class="mb-4">
                <input type="text" wire:model.live="search" placeholder="بحث عن صنف..." 
                       class="w-full md:w-96 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>
        </div>

        @if($categories->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($categories as $category)
                    <a href="{{ route('categories.show', $category->id) }}" 
                       class="bg-white rounded-lg shadow-sm hover:shadow-lg transition-shadow overflow-hidden group">
                        <div class="relative overflow-hidden">
                            @if($category->image)
                                <img src="{{ asset('storage/' . $category->image) }}" 
                                     alt="{{ $category->name }}" 
                                     class="w-full h-48 object-cover group-hover:scale-110 transition-transform duration-300">
                            @else
                                <div class="w-full h-48 bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center">
                                    <span class="text-white text-4xl font-bold">{{ mb_substr($category->name, 0, 1) }}</span>
                                </div>
                            @endif
                        </div>
                        <div class="p-4">
                            <h3 class="font-bold text-lg text-gray-900 mb-2 group-hover:text-blue-600 transition">
                                {{ $category->name }}
                            </h3>
                            @if($category->description)
                                <p class="text-sm text-gray-600 mb-3 line-clamp-2">{{ Str::limit($category->description, 60) }}</p>
                            @endif
                            <div class="flex items-center text-sm text-gray-500">
                                <span>{{ $category->products_count }} منتج</span>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>

            <div class="mt-8">
                {{ $categories->links() }}
            </div>
        @else
            <div class="bg-white rounded-lg shadow-sm p-12 text-center">
                <p class="text-gray-500 text-lg">لا توجد أصناف متاحة</p>
            </div>
        @endif
    </div>

