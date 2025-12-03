<?php

use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\Auth;
use Livewire\Volt\Component;

new class extends Component
{
    public string $password = '';
    
    protected $layout = 'components.front-layout';

    /**
     * Delete the currently authenticated user.
     */
    public function deleteUser(Logout $logout): void
    {
        $this->validate([
            'password' => ['required', 'string', 'current_password'],
        ]);

        tap(Auth::user(), $logout(...))->delete();

        $this->redirect('/', navigate: true);
    }
}; ?>


<section class="space-y-6 p-6 bg-white shadow-xl rounded-xl border border-red-100/50" dir="ltr">
    <header>
        <h2 class="text-2xl font-bold text-red-600">
            {{ __('Delete Account') }}
        </h2>

        <p class="mt-1 text-sm text-gray-700">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    <!-- زر الحذف باللون الأحمر الداكن للتأكيد على خطورة الإجراء -->
    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="bg-red-700 hover:bg-red-800 active:bg-red-900 focus:ring-red-500"
    >{{ __('Delete Account') }}</x-danger-button>

    <!-- Modal التأكيد - تم تعديل التنسيق الداخلي ليتوافق مع الأبيض والأحمر -->
    <x-modal name="confirm-user-deletion" :show="$errors->isNotEmpty()" focusable>
        <form wire:submit="deleteUser" class="p-6">

            <h2 class="text-xl font-extrabold text-red-800">
                {{ __('Are you sure you want to delete your account?') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />

                <x-text-input
                    wire:model="password"
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-full border-gray-300 focus:border-red-500 focus:ring-red-500 rounded-md shadow-sm"
                    placeholder="{{ __('Password') }}"
                />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end">
                <!-- زر الإلغاء بلون رمادي فاتح محايد -->
                <x-secondary-button x-on:click="$dispatch('close')" class="text-gray-700 hover:bg-gray-100">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <!-- زر الحذف النهائي باللون الأحمر الداكن للتأكيد -->
                <x-danger-button class="ms-3 bg-red-700 hover:bg-red-800 active:bg-red-900 focus:ring-red-500">
                    {{ __('Delete Account') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>