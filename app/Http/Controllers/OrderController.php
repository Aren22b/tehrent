<?php
namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::all();
        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        return view('orders.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'type_of_work' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'distance' => 'required|numeric',
            'price_per_hour' => 'required|numeric',
            'duration' => 'required|integer',
            'payment_form' => 'required|in:cash,cashless',
            'latitude' => 'required|numeric', // Проверка широты
            'longitude' => 'required|numeric', // Проверка долготы
            'additional_info' => 'nullable|string',
        ]);
        
        // Добавляем user_id в данные перед созданием заказа
        $validatedData['user_id'] = auth()->id();

        Order::create($validatedData);

        return redirect()->route('orders.index')->with('success', 'Order created successfully');
    }

    public function show(Order $order)
    {
        return view('orders.show', compact('order'));
    }

    public function edit(Order $order)
    {
        return view('orders.edit', compact('order'));
    }

    public function update(Request $request, Order $order)
    {
        $validatedData = $request->validate([
            'type_of_work' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'distance' => 'required|numeric',
            'price_per_hour' => 'required|numeric',
            'duration' => 'required|integer',
            'payment_form' => 'required|in:cash,cashless',
            'latitude' => 'required|numeric', // Проверка широты
            'longitude' => 'required|numeric', // Проверка долготы
            'additional_info' => 'nullable|string',
        ]);
        
        $order->update($validatedData);

        return redirect()->route('orders.index')->with('success', 'Order updated successfully');
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('orders.index')->with('success', 'Order deleted successfully');
    }

    public function map()
    {
        $orders = Order::all(); // Получаем все заказы из базы данных
        return view('map', compact('orders')); // Предполагаем, что у вас есть представление 'map.blade.php'
    }
}
