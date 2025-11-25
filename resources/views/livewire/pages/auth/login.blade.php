<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

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

        // بعد تسجيل الدخول، توجيه الآدمن مباشرة للوحة التحكم
        $this->redirectIntended(default: route('admin.categories.index', absolute: false), navigate: true);
    }
}; ?>

<div class="flex flex-col items-center justify-center min-h-[80vh] py-12 px-4 sm:px-6 lg:px-8" dir="rtl">
    
    <!-- Logo Section -->
    <div class="flex flex-col items-center mb-8">
        <div class="bg-indigo-600 p-3 rounded-xl shadow-lg shadow-indigo-500/20 mb-4 transform hover:scale-105 transition-transform duration-300">
            <svg class="w-10 h-10 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
            </svg>
        </div>
        <h2 class="text-3xl font-bold text-slate-100 tracking-tight">Amara<span class="text-indigo-400">Food</span></h2>
        <p class="mt-2 text-sm text-slate-400">تسجيل الدخول للوحة التحكم</p>
    </div>

    <!-- Login Card -->
    <div class="w-full max-w-md bg-slate-800 border border-slate-700/50 shadow-2xl rounded-2xl overflow-hidden backdrop-blur-sm">
        <div class="p-8">
            <!-- Session Status -->
            @if (session('status'))
                <div class="mb-4 font-medium text-sm text-emerald-400 bg-emerald-900/30 p-3 rounded-lg border border-emerald-500/20 text-center">
                    {{ session('status') }}
                </div>
            @endif

            <form wire:submit="login" class="space-y-6">
                <!-- Email Address -->
                <div>
                    <label for="email" class="block text-sm font-medium text-slate-300 mb-2">البريد الإلكتروني</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                            </svg>
                        </div>
                        <input wire:model="form.email" id="email" type="email" name="email" required autofocus autocomplete="username" 
                            class="block w-full pr-10 pl-3 py-2.5 bg-slate-900 border border-slate-700 rounded-xl text-slate-100 placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200 sm:text-sm" 
                            placeholder="example@amarafood.com">
                    </div>
                    @error('form.email') 
                        <p class="mt-2 text-sm text-red-400 flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            {{ $message }}
                        </p> 
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-slate-300 mb-2">كلمة المرور</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <input wire:model="form.password" id="password" type="password" name="password" required autocomplete="current-password"
                            class="block w-full pr-10 pl-3 py-2.5 bg-slate-900 border border-slate-700 rounded-xl text-slate-100 placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200 sm:text-sm"
                            placeholder="••••••••">
                    </div>
                    @error('form.password') 
                        <p class="mt-2 text-sm text-red-400 flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            {{ $message }}
                        </p> 
                    @enderror
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="flex items-center justify-between">
                    <label for="remember" class="inline-flex items-center cursor-pointer group">
                        <div class="relative">
                            <input wire:model="form.remember" id="remember" type="checkbox" class="sr-only peer">
                            <div class="w-5 h-5 border-2 border-slate-600 rounded bg-slate-900 peer-checked:bg-indigo-600 peer-checked:border-indigo-600 transition-all duration-200"></div>
                            <svg class="absolute top-1 right-1 w-3 h-3 text-white hidden peer-checked:block pointer-events-none" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <span class="ms-2 text-sm text-slate-400 group-hover:text-slate-300 transition-colors">تذكرني</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a class="text-sm text-indigo-400 hover:text-indigo-300 transition-colors focus:outline-none focus:underline" href="{{ route('password.request') }}" wire:navigate>
                            نسيت كلمة المرور؟
                        </a>
                    @endif
                </div>

                <!-- Submit Button -->
                <div>
                    <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-sm text-sm font-semibold text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-slate-800 focus:ring-indigo-500 transition-all duration-200 hover:shadow-lg hover:shadow-indigo-500/30">
                        تسجيل الدخول
                        <svg class="mr-2 -ml-1 w-5 h-5 text-indigo-100" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14" />
                        </svg>
                    </button>
                </div>
            </form>
        </div>
        
        <!-- Footer area inside card -->
        <div class="px-8 py-4 bg-slate-900/50 border-t border-slate-700/50 text-center">
            <p class="text-xs text-slate-500">
                &copy; {{ date('Y') }} AmaraFood Systems. جميع الحقوق محفوظة.
            </p>
        </div>
    </div>
</div>