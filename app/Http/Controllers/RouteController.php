<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RouteController extends Controller
{
    // Метод для получения данных маршрута от OSRM
    public function getRoute($startLong, $startLat, $endLong, $endLat) {
        $response = Http::get("http://localhost:5000/route/v1/driving/{$startLong},{$startLat};{$endLong},{$endLat}?steps=true");
        
        // Проверяем, что запрос был успешным
        if ($response->successful()) {
            return $response->json();
        } else {
            return response()->json(["error" => "Не удалось получить маршрут."], 422);
        }
    }
}
