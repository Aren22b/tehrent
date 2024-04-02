<?php

use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PerformerController;
use App\Models\Order;
use App\Http\Controllers\ProfileController;


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
    Route::get('/performer', [PerformerController::class, 'showPerformerPage']);
    //Route::get('/test-performer-location', [PerformerController::class, 'getPerformerLocation']);
    //Route::get('/performer-location', [PerformerController::class, 'getPerformerLocation']);
});


Route::get('get/performer-locations', [PerformerController::class, 'getPerformersLocation']);
Route::post('set/performer-status', [PerformerController::class, 'updateStatus']);

// Маршрут для страницы с картой, с передачей заказов
Route::get('/map', function () {
    $orders = Order::all(); // Получаем все заказы из базы данных
    // dd($orders); // Уберите или закомментируйте эту строку после отладки
    return view('map', compact('orders')); // Передаем заказы в представление
});

require __DIR__.'/auth.php';
