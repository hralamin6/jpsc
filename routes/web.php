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

//Route::get('/', function () {
//    Route::get('/',\App\Http\Livewire\HomeComponent::class)->name('home');
//});

    Route::get('shop',\App\Http\Livewire\HomeComponent::class)->name('home');

Route::middleware(['auth:sanctum', 'verified', 'admin'])->group(function () {
    Route::get('/',\App\Http\Livewire\Admin\DashboardComponent::class)->name('dashboard');
    Route::get('/categories',\App\Http\Livewire\Admin\CategoryComponent::class)->name('dashboard.categories');
    Route::get('/customers',\App\Http\Livewire\Admin\CustomerComponent::class)->name('dashboard.customers');
    Route::get('/sellers',\App\Http\Livewire\Admin\SellerComponent::class)->name('dashboard.sellers');
    Route::get('/admins',\App\Http\Livewire\Admin\UserComponent::class)->name('dashboard.admins');
    Route::get('/products',\App\Http\Livewire\Admin\ProductComponent::class)->name('dashboard.products');
    Route::get('/purchases',\App\Http\Livewire\Admin\PurchaseComponent::class)->name('dashboard.purchases');
    Route::get('/sells',\App\Http\Livewire\Admin\SellComponent::class)->name('dashboard.sells');
    Route::get('/setup',\App\Http\Livewire\Admin\SetupComponent::class)->name('dashboard.setup');
    Route::get('/profile',\App\Http\Livewire\Admin\ProfileComponent::class)->name('dashboard.profile');
    Route::get('/customer/{id}',\App\Http\Livewire\Admin\CustomerPaymentComponent::class)->name('dashboard.customer.payment');
});
Route::get('lang/home', [\App\Http\Controllers\LangController::class, 'index']);
Route::post('lang/change', [\App\Http\Controllers\LangController::class, 'change'])->name('changeLang');
