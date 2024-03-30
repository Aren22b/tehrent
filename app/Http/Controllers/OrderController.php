<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::all(); // Получаем все заявки из базы данных
        return view('orders.index', compact('orders')); // Отправляем их в представление
    }
    

    public function create()
{
    return view('orders.create'); // Возвращает представление с формой для создания заявки
}

public function store(Request $request)
{
    $validatedData = $request->validate([
        'user_id' => 'required|exists:users,id',
        'type_of_work' => 'required|string|max:255',
        'address' => 'required|string|max:255',
        'distance' => 'required|numeric',
        'price_per_hour' => 'required|numeric',
        'duration' => 'required|integer',
        'payment_form' => 'required|in:cash,cashless',
        'additional_info' => 'nullable|string',
    ]);

    $order = Order::create($validatedData);

    return redirect()->route('orders.index')->with('success', 'Order created successfully');
}

public function show(Order $order)
{
    return view('orders.show', compact('order')); // Возвращает представление с подробной информацией о заявке
}

public function edit(Order $order)
{
    return view('orders.edit', compact('order')); // Возвращает представление с формой для редактирования заявки
}


public function update(Request $request, Order $order)
{
    $validatedData = $request->validate([
        // Правила валидации такие же, как и в методе store
    ]);

    $order->update($validatedData);

    return redirect()->route('orders.index')->with('success', 'Order updated successfully');
}

public function destroy(Order $order)
{
    $order->delete();

    return redirect()->route('orders.index')->with('success', 'Order deleted successfully');
}



