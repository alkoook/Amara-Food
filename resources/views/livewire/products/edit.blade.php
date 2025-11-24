<div class="mb-6">
        <a href="{{ route('admin.products.index') }}" class="text-blue-600 hover:text-blue-800">
            ← العودة إلى قائمة المنتجات
        </a>
    </div>

    <div class="bg-white rounded-lg shadow-sm p-6 max-w-4xl">
        <h3 class="text-xl font-bold text-gray-800 mb-6">تعديل المنتج</h3>

        <form wire:submit="update">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">اسم المنتج *</label>
                    <input type="text" wire:model="name" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">وصف المنتج *</label>
                    <textarea wire:model="description" rows="4" 
                              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"></textarea>
                    @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">الصنف *</label>
                    <select wire:model="category_id" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">اختر الصنف</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">الشركة *</label>
                    <select wire:model="brand_id" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">اختر الشركة</option>
                        @foreach($brands as $brand)
                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                        @endforeach
                    </select>
                    @error('brand_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">صورة المنتج</label>
                    @if($oldImage)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $oldImage) }}" alt="Current" class="h-32 w-32 object-cover rounded">
                        </div>
                    @endif
                    <input type="file" wire:model="image" accept="image/*" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    @error('image') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    @if($image)
                        <div class="mt-2">
                            <img src="{{ $image->temporaryUrl() }}" alt="Preview" class="h-32 w-32 object-cover rounded">
                        </div>
                    @endif
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">تاريخ الإضافة *</label>
                    <input type="date" wire:model="added_date" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    @error('added_date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">الوزن (كجم)</label>
                    <input type="number" step="0.01" wire:model="weight" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    @error('weight') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">الكمية</label>
                    <input type="number" wire:model="quantity" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    @error('quantity') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">تاريخ انتهاء الصلاحية</label>
                    <input type="date" wire:model="expiry_date" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    @error('expiry_date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="mt-6 flex gap-4">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg">
                    تحديث
                </button>
                <a href="{{ route('admin.products.index') }}" 
                   class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-6 py-2 rounded-lg">
                    إلغاء
                </a>
            </div>
        </form>
    </div>

