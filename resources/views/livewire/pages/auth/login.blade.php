<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

// تم الرجوع لـ layouts.guest بناءً على طلبك في الكود المرفق
new #[Layout('layouts.guest')] class extends Component
{
    public LoginForm $form;

    /**
     * Handle an incoming authentication request (admin only).
     */
    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        // توجيه الآدمن
        $this->redirectIntended(default: route('admin.dashboard', absolute: false), navigate: true);
    }
}; ?>

<!-- استخدمنا flex justify-center لضمان تمركز المحتوى في صفحة الـ guest layout -->
<div class="flex flex-col items-center justify-center min-h-[90vh] py-12 px-4 sm:px-6 lg:px-8 w-full" dir="rtl">

    <!-- Logo Section - تصميم بسيط وأنيق -->
    <div class="flex flex-col items-center mb-10">
        <div class="bg-indigo-600 p-4 rounded-3xl shadow-2xl shadow-indigo-500/30 mb-5 transform hover:scale-[1.02] transition-transform duration-300 ring-2 ring-white/10">
            <!-- أيقونة تعبر عن الغذاء/الطبق - تمثل شعار AmaraFood -->
            <svg class="w-12 h-12 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
            </svg>
        </div>
        <h2 class="text-4xl font-extrabold text-white tracking-tight drop-shadow-md"><span class="text-indigo-400">Amara Food</span></h2>
        <p class="mt-3 text-base text-slate-300 font-medium">تسجيل الدخول للوحة التحكم</p>
    </div>

    <!-- Login Card - الـ div الغامق الرئيسي -->
    <div class="w-full max-w-[420px] bg-slate-800/90 border border-slate-700/50 shadow-[0_20px_50px_-5px_rgba(0,0,0,0.5)] rounded-2xl overflow-hidden backdrop-blur-md ring-1 ring-white/5">
        <div class="p-8 sm:p-10">

            <!-- تم إزالة Session Status بالكامل بناءً على طلب إزالة "الديف الأبيض" -->

            <form wire:submit="login" class="space-y-6">
                <!-- Email Address -->
                <div>
                    <label for="email" class="block text-sm font-bold text-slate-100 mb-2">البريد الإلكتروني</label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                            <!-- أيقونة الإيميل -->
                            <svg class="h-5 w-5 text-slate-400 group-focus-within:text-indigo-400 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                            </svg>
                        </div>
                        <input wire:model="form.email" id="email" type="email" name="email" required autofocus autocomplete="username"
                            class="block w-full pr-10 pl-3 py-3.5 bg-slate-900 border border-slate-600 rounded-xl text-white placeholder-slate-500 text-base focus:outline-none focus:ring-2 focus:ring-indigo-500/60 focus:border-indigo-500 transition-all duration-200 shadow-md hover:border-indigo-500/50"
                            placeholder="الرجاء إدخال البريد الإلكتروني">
                    </div>
                    @error('form.email')
                        <p class="mt-2 text-sm text-red-300 flex items-center gap-1 font-medium">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-bold text-slate-100 mb-2">كلمة المرور</label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                            <!-- أيقونة القفل -->
                            <svg class="h-5 w-5 text-slate-400 group-focus-within:text-indigo-400 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <input wire:model="form.password" id="password" type="password" name="password" required autocomplete="current-password"
                            class="block w-full pr-10 pl-3 py-3.5 bg-slate-900 border border-slate-600 rounded-xl text-white placeholder-slate-500 text-base focus:outline-none focus:ring-2 focus:ring-indigo-500/60 focus:border-indigo-500 transition-all duration-200 shadow-md hover:border-indigo-500/50"
                            placeholder="••••••••">
                    </div>
                    @error('form.password')
                        <p class="mt-2 text-sm text-red-300 flex items-center gap-1 font-medium">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="flex items-center justify-between pt-1">
                    <label for="remember" class="inline-flex items-center cursor-pointer group select-none">
                        <div class="relative flex items-center">
                            <input wire:model="form.remember" id="remember" type="checkbox" class="peer sr-only">
                            <div class="w-4 h-4 border border-slate-500 rounded-md bg-slate-700/50 peer-checked:bg-indigo-600 peer-checked:border-indigo-600 transition-all duration-200 shadow-sm"></div>
                            <svg class="absolute inset-0 w-4 h-4 text-white hidden peer-checked:block pointer-events-none" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                            </svg>
                            <span class="ms-3 text-sm text-slate-300 group-hover:text-white transition-colors font-medium">تذكرني</span>
                        </div>
                    </label>

                    @if (Route::has('password.request'))
                        <a class="text-sm font-medium text-indigo-400 hover:text-indigo-300 transition-colors focus:outline-none hover:underline" href="{{ route('password.request') }}" wire:navigate>
                            نسيت كلمة المرور؟
                        </a>
                    @endif
                </div>

                <!-- Submit Button -->
                <button type="submit" class="w-full flex justify-center items-center py-3.5 px-4 border border-transparent rounded-xl shadow-xl shadow-indigo-600/30 text-base font-bold text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-slate-800 focus:ring-indigo-500 transition-all duration-300 hover:-translate-y-0.5 mt-8">
                    تسجيل الدخول
                    <svg class="mr-2 -ml-1 w-5 h-5 text-indigo-100 transform rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14" />
                    </svg>
                </button>
            </form>
        </div>

        <!-- Footer area -->
        <div class="px-8 py-4 bg-slate-900 border-t border-slate-700/50 text-center">
            <p class="text-[10px] text-slate-500 font-normal">
                &copy; {{ date('Y') }} AmaraFood Systems. v1.0.0
            </p>
        </div>
    </div>
</div>
