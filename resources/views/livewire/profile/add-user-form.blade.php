<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Livewire\Volt\Component;

new class extends Component
{
    // الخصائص اللازمة لإنشاء مستخدم جديد
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';
    
    // استخدام نفس تخطيط الواجهة الأمامية
    protected $layout = 'components.front-layout';

    /**
     * Store a newly created user in the database.
     */
    public function createUser(): void
    {
        // قواعد التحقق من الصحة
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'string', Password::defaults(), 'confirmed'],
        ]);

        // إنشاء المستخدم
        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        // إعادة تعيين الحقول وإرسال حدث (Event) للتأكيد
        $this->reset('name', 'email', 'password', 'password_confirmation');
        
        // إرسال حدث لتأكيد نجاح العملية
        $this->dispatch('user-created');
    }
}; ?>


<section class="p-6 bg-white shadow-xl rounded-xl border border-red-100/50 max-w-lg mx-auto" dir="ltr">
    <header>
        <h2 class="text-2xl font-bold text-red-600">
            {{ __('Add New User') }}
        </h2>

        <p class="mt-1 text-sm text-gray-700">
            {{ __('Enter the details for the new account including name, email, and password.') }}
        </p>
    </header>

    <form wire:submit="createUser" class="mt-6 space-y-6">
        <!-- حقل الاسم (Name) -->
        <div>
            <x-input-label for="name" :value="__('Name')" class="text-red-700 font-semibold" />
            <x-text-input wire:model="name" id="name" name="name" type="text" 
                          class="mt-1 block w-full border-gray-300 focus:border-red-500 focus:ring-red-500 rounded-md shadow-sm" 
                          required autofocus autocomplete="off" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <!-- حقل البريد الإلكتروني (Email) -->
        <div>
            <x-input-label for="email" :value="__('Email')" class="text-red-700 font-semibold" />
            <x-text-input wire:model="email" id="email" name="email" type="email" 
                          class="mt-1 block w-full border-gray-300 focus:border-red-500 focus:ring-red-500 rounded-md shadow-sm" 
                          required autocomplete="off" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />
        </div>

        <!-- حقل كلمة المرور (Password) -->
        <div>
            <x-input-label for="password" :value="__('Password')" class="text-red-700 font-semibold" />
            <x-text-input wire:model="password" id="password" name="password" type="password" 
                          class="mt-1 block w-full border-gray-300 focus:border-red-500 focus:ring-red-500 rounded-md shadow-sm" 
                          required autocomplete="new-password" />
            <x-input-error class="mt-2" :messages="$errors->get('password')" />
        </div>

        <!-- حقل تأكيد كلمة المرور (Confirm Password) -->
        <div>
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-red-700 font-semibold" />
            <x-text-input wire:model="password_confirmation" id="password_confirmation" name="password_confirmation" type="password" 
                          class="mt-1 block w-full border-gray-300 focus:border-red-500 focus:ring-red-500 rounded-md shadow-sm" 
                          required autocomplete="new-password" />
            <x-input-error class="mt-2" :messages="$errors->get('password_confirmation')" />
        </div>

        <div class="flex items-center gap-4">
            <!-- الزر الرئيسي لإنشاء الحساب -->
            <x-primary-button class="bg-red-600 hover:bg-red-700 focus:ring-red-500">{{ __('Create Account') }}</x-primary-button>

            <!-- رسالة الإجراء باللون الأحمر -->
            <x-action-message class="ms-3 text-red-600 font-medium" on="user-created">
                {{ __('User created successfully.') }}
            </x-action-message>
        </div>
    </form>
</section>