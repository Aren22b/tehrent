<?php

use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PerformerController;
use App\Models\Order;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('orders', OrderController::class);
    Route::get('/performers', [PerformerController::class, 'index']);
    Route::get('/map', function () {
        $orders = Order::all(); // Получаем все заказы из базы данных
        return view('map', compact('orders')); // Передаём их в представление
});
});

require __DIR__.'/auth.php';
