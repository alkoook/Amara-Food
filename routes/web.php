<?php

use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\Route;

// Front Routes
Route::get('/', \App\Livewire\Front\Home::class)->name('home');
Route::get('/products', \App\Livewire\Front\ProductsIndex::class)->name('products.index');
Route::get('/products/{id}', \App\Livewire\Front\ProductShow::class)->name('products.show');
Route::get('/categories', \App\Livewire\Front\CategoriesIndex::class)->name('categories.index');
Route::get('/categories/{id}', \App\Livewire\Front\CategoryProducts::class)->name('categories.show');
Route::get('/brands', \App\Livewire\Front\BrandsIndex::class)->name('brands.index');
Route::get('/brands/{id}', \App\Livewire\Front\BrandProducts::class)->name('brands.show');
Route::get('/about', function () {
    return view('about');
})->name('about');
Route::get('/contact', \App\Livewire\Front\Contact::class)->name('contact');

// Admin Routes (لوحة تحكم مستقلة تماماً)
Route::prefix('admin')->middleware('auth')->name('admin.')->group(function () {

Route::get('/', \App\Livewire\Admin\Dashboard\Index::class)->name('dashboard');


    Route::post('/logout', Logout::class)->name('logout');

    // Categories
    Route::get('/categories', \App\Livewire\Categories\Index::class)->name('categories.index');
    Route::get('/categories/create', \App\Livewire\Categories\Create::class)->name('categories.create');
    Route::get('/categories/{id}/edit', \App\Livewire\Categories\Edit::class)->name('categories.edit');

    // Brands
    Route::get('/brands', \App\Livewire\Brands\Index::class)->name('brands.index');
    Route::get('/brands/create', \App\Livewire\Brands\Create::class)->name('brands.create');
    Route::get('/brands/{id}/edit', \App\Livewire\Brands\Edit::class)->name('brands.edit');

    // Products
    Route::get('/products', \App\Livewire\Products\Index::class)->name('products.index');
    Route::get('/products/create', \App\Livewire\Products\Create::class)->name('products.create');
    Route::get('/products/{id}/edit', \App\Livewire\Products\Edit::class)->name('products.edit');
    Route::get('/products/{id}', \App\Livewire\Products\Show::class)->name('products.show');

    // Settings
    Route::get('/settings', \App\Livewire\Settings\Index::class)->name('settings.index');
});

// لم نعد نستخدم Dashboard و Profile العامة لليوزر

require __DIR__.'/auth.php';
