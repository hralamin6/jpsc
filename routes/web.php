<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified', 'admin'])->group(function () {
    Route::get('/dashboard',\App\Http\Livewire\Admin\DashboardComponent::class)->name('dashboard');
    Route::get('/dashboard/categories',\App\Http\Livewire\Admin\CategoryComponent::class)->name('dashboard.categories');
    Route::get('/dashboard/customers',\App\Http\Livewire\Admin\CustomerComponent::class)->name('dashboard.customers');
    Route::get('/dashboard/sellers',\App\Http\Livewire\Admin\SellerComponent::class)->name('dashboard.sellers');
    Route::get('/dashboard/products',\App\Http\Livewire\Admin\ProductComponent::class)->name('dashboard.products');
    Route::get('/dashboard/purchases',\App\Http\Livewire\Admin\PurchaseComponent::class)->name('dashboard.purchases');
    Route::get('/dashboard/sells',\App\Http\Livewire\Admin\SellComponent::class)->name('dashboard.sells');
    Route::get('/dashboard/customer/{id}',\App\Http\Livewire\Admin\CustomerPaymentComponent::class)->name('dashboard.customer.payment');
});
