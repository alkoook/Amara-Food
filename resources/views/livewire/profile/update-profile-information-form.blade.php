<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Livewire\Volt\Component;

new class extends Component
{
    public string $name = '';
    public string $email = '';
    
    protected $layout = 'components.front-layout';

    /**
     * Mount the component.
     */
    public function mount(): void
    {
        $this->name = Auth::user()->name;
        $this->email = Auth::user()->email;
    }

    /**
     * Update the profile information for the currently authenticated user.
     */
    public function updateProfileInformation(): void
    {
        $user = Auth::user();

        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($user->id)],
        ]);

        $user->fill($validated);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        $this->dispatch('profile-updated', name: $user->name);
    }

    /**
     * Send an email verification notification to the current user.
     */
    public function sendVerification(): void
    {
        $user = Auth::user();

        if ($user->hasVerifiedEmail()) {
            $this->redirectIntended(default: route('dashboard', absolute: false));

            return;
        }

        $user->sendEmailVerificationNotification();

        Session::flash('status', 'verification-link-sent');
    }
}; ?>

<!-- البطاقة الخارجية البيضاء الجديدة بالتنسيق المطلوب -->
<section class="p-6 bg-white shadow-xl rounded-xl border border-red-100/50" dir="ltr">
    <header>
        <h2 class="text-2xl font-bold text-red-600">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-700">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form wire:submit="updateProfileInformation" class="mt-6 space-y-6">
        <div>
            <x-input-label for="name" :value="__('Name')" class="text-red-700 font-semibold" />
            <x-text-input wire:model="name" id="name" name="name" type="text" 
                          class="mt-1 block w-full border-gray-300 focus:border-red-500 focus:ring-red-500 rounded-md shadow-sm" 
                          required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" class="text-red-700 font-semibold" />
            <x-text-input wire:model="email" id="email" name="email" type="email" 
                          class="mt-1 block w-full border-gray-300 focus:border-red-500 focus:ring-red-500 rounded-md shadow-sm" 
                          required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if (auth()->user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! auth()->user()->hasVerifiedEmail())
                <div class="p-3 mt-3 bg-red-50 border border-red-300 rounded-lg">
                    <p class="text-sm text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <!-- الزر الآن باللون الأحمر المميز بدلاً من الأزرق/الرمادي -->
                        <button wire:click.prevent="sendVerification" class="underline text-sm text-red-600 hover:text-red-800 font-medium rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <!-- رسالة التأكيد باللون الأخضر مع بقاء الإطار أحمر (لأنها داخل بطاقة التنبيه) -->
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <!-- استخدام كلاسات Tailwind لضمان اللون الأحمر الرئيسي للزر -->
            <x-primary-button class="bg-red-600 hover:bg-red-700 focus:ring-red-500">{{ __('Save') }}</x-primary-button>

            <!-- رسالة الإجراء باللون الأحمر -->
            <x-action-message class="me-3 text-red-600 font-medium" on="profile-updated">
                {{ __('Saved.') }}
            </x-action-message>
        </div>
    </form>
</section>