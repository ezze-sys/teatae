<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', App\Livewire\Admin\Dashboard::class)->name('dashboard');
    Route::get('/products', App\Livewire\Admin\Products::class)->name('products');
    Route::get('/customers', App\Livewire\Admin\Customers::class)->name('customers');
    Route::get('/waste', App\Livewire\Admin\Waste::class)->name('waste');
    
    Route::get('/test-alpine', function () {
    return view('test_alpine');
});

Route::get('/pos', App\Livewire\Pos\Pos::class)->name('pos');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
