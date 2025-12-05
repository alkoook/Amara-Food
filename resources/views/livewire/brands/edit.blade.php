<div>
<div class="mb-6">
        <a href="{{ route('admin.brands.index') }}" class="text-blue-600 hover:text-blue-800">
           {{ __('Go to Brands →') }}
        </a>
    </div>

    <div class="bg-white rounded-lg shadow-sm p-6 max-w-3xl">
        <h3 class="text-xl font-bold text-gray-800 mb-6">{{ __('Edit Brand') }}</h3>

        <form wire:submit="update" enctype="multipart/form-data">
            <div class="space-y-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2"> {{ __('Name') }}</label>
                    <input type="text" wire:model="name"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">{{ __('Description') }}</label>
                    <textarea wire:model="description" rows="4"
                              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"></textarea>
                    @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">{{ __('Image') }} </label>
                    @if($oldLogo)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $oldLogo) }}" alt="Current" class="h-32 w-32 object-cover rounded">
                        </div>
                    @endif
                    <input type="file" wire:model="logo" accept="image/*"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    @error('logo') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    @if($logo)
                        <div class="mt-2">
                            <img src="{{ $logo->temporaryUrl() }}" alt="Preview" class="h-32 w-32 object-cover rounded">
                        </div>
                    @endif
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2"> {{ __('Categories Related With This Brand') }}</label>
                    <div class="space-y-2 max-h-48 overflow-y-auto border border-gray-300 rounded-lg p-4">
                        @foreach($categories as $category)
                            <label class="flex items-center">
                                <input type="checkbox" wire:model="selectedCategories" value="{{ $category->id }}"
                                       class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                <span class="mr-2 text-sm text-gray-700">{{ $category->name }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>

                <div class="flex gap-4">
                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded-lg">
                   {{ __('Update') }}
                    </button>
                    <a href="{{ route('admin.brands.index') }}"
                       class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-6 py-2 rounded-lg">
                        {{ __('Cancel') }}
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>
