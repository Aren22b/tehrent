<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Добавлено использование модели User
use App\Models\Performer;
use App\Models\Order; // Добавлено использование модели Order, если вы используете её в методе map()

class PerformerController extends Controller
{
    public function index()
    {
        // Здесь должна быть ваша логика для обработки индексного действия
    }

    // ... остальные методы ...

    public function map()
    {
        $orders = Order::all(); // Убедитесь, что у вас есть модель Order, если нет, удалите эту строку
        return view('map', compact('orders'));
    }

    public function updateStatus(Request $request)
    {
        $request->validate([
            'is_online' => 'required|boolean',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        $performer = auth()->user()->performer;
        $performer->update([
            'is_online' => $request->is_online,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ]);

        return response()->json(['message' => 'Статус успешно обновлен']);
    }

    public function getPerformersLocation()
    {
        $performers = Performer::where('is_online', true)->get(['latitude', 'longitude', 'name']);
        return response()->json($performers);
    }

    public function getPerformerLocation()
    {
        $user = auth()->user();
        if ($user && $user->performer) {
            return response()->json([
                'latitude' => $user->performer->latitude,
                'longitude' => $user->performer->longitude,
                'name' => $user->performer->name
            ]);
        } else {
            return response()->json(['error' => 'Исполнитель не найден'], 404);
        }
    }

    public function showPerformerPage()
    {
        $user = auth()->user();

        if ($user && $user->performer) {
            $performer = $user->performer;
            return view('performer', compact('performer'));
        } else {
            return redirect('/login')->with('error', 'You need to login and have a performer profile to access this page.');
        }
    }

}
