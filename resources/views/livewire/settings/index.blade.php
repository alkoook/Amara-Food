<div class="bg-white rounded-lg shadow-sm p-6 max-w-4xl">
        <h3 class="text-xl font-bold text-gray-800 mb-6">{{ __('Settings') }}</h3>

        <form wire:submit="save">
            <div class="space-y-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">{{ __('The Company Overview') }}</label>
                    <textarea wire:model="companyOverview" rows="6"
                              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                              placeholder="{{ __('Write The Company Overview') }}..."></textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">{{ __('Email') }}</label>
                        <input type="email" wire:model="email"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                               placeholder="example@email.com">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2"> {{ __('Phone Number') }}</label>
                        <input type="text" wire:model="phone"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                               placeholder="+963XXXXXXXXX">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2"> {{ __('Address') }} </label>
                         <textarea wire:model="address" rows="6"
                              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                              placeholder="{{ __('Write The Address') }}">{{ $address }}</textarea>
                    </div>
                         <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">{{ __('Location') }} </label>
                        <input type="text" wire:model="location"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                               placeholder="Enter The Location From Google Map">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2"> {{ __('Facebook') }}</label>
                        <input type="url" wire:model="facebook"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                               placeholder="https://facebook.com/...">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2"> {{ __('Twitter') }}</label>
                        <input type="url" wire:model="twitter"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                               placeholder="https://twitter.com/...">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2"> {{ __('Instagram') }}</label>
                        <input type="url" wire:model="instagram"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                               placeholder="https://instagram.com/...">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2"> {{ __('WhatsApp') }}</label>
                        <input type="text" wire:model="whatsapp"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                               placeholder="+966XXXXXXXXX">
                    </div>
                </div>

                <div class="flex gap-4">
                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded-lg">
                        {{ __('Save') }}
                    </button>
                </div>
            </div>
        </form>
    </div>

