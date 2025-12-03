<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;
use Livewire\Volt\Component;

new class extends Component
{
    public string $current_password = '';
    public string $password = '';
    public string $password_confirmation = '';
    
    protected $layout = 'components.front-layout';

    /**
     * Update the password for the currently authenticated user.
     */
    public function updatePassword(): void
    {
        try {
            $validated = $this->validate([
                'current_password' => ['required', 'string', 'current_password'],
                'password' => ['required', 'string', Password::defaults(), 'confirmed'],
            ]);
        } catch (ValidationException $e) {
            $this->reset('current_password', 'password', 'password_confirmation');

            throw $e;
        }

        Auth::user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        $this->reset('current_password', 'password', 'password_confirmation');

        $this->dispatch('password-updated');
    }
}; ?>

<!-- البطاقة الخارجية البيضاء الجديدة بالتنسيق المطلوب -->
<section class="p-6 bg-white shadow-xl rounded-xl border border-red-100/50" dir="ltr">
    <header>
        <h2 class="text-2xl font-bold text-red-600">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-1 text-sm text-gray-700">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form wire:submit="updatePassword" class="mt-6 space-y-6">
        <div>
            <x-input-label for="update_password_current_password" :value="__('Current Password')" class="text-red-700 font-semibold" />
            <x-text-input wire:model="current_password" id="update_password_current_password" name="current_password" type="password" 
                          class="mt-1 block w-full border-gray-300 focus:border-red-500 focus:ring-red-500 rounded-md shadow-sm" 
                          autocomplete="current-password" />
            <x-input-error :messages="$errors->get('Current Password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_password_password" :value="__('New Password')" class="text-red-700 font-semibold" />
            <x-text-input wire:model="password" id="update_password_password" name="password" type="password" 
                          class="mt-1 block w-full border-gray-300 focus:border-red-500 focus:ring-red-500 rounded-md shadow-sm" 
                          autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_password_password_confirmation" :value="__('Confirm Password')" class="text-red-700 font-semibold" />
            <x-text-input wire:model="password_confirmation" id="update_password_password_confirmation" name="password_confirmation" type="password" 
                          class="mt-1 block w-full border-gray-300 focus:border-red-500 focus:ring-red-500 rounded-md shadow-sm" 
                          autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <!-- استخدام كلاسات Tailwind لضمان اللون الأحمر الرئيسي للزر -->
            <x-primary-button class="bg-red-600 hover:bg-red-700 focus:ring-red-500">{{ __('Update Password') }}</x-primary-button>

            <!-- رسالة الإجراء باللون الأحمر -->
            <x-action-message class="me-3 text-red-600 font-medium" on="password-updated">
                {{ __('Update Password Done') }}
            </x-action-message>
        </div>
    </form>
</section>