<?php

namespace App\Http\Controllers;

use App\Models\Performer;
use Illuminate\Http\Request;

class PerformerController extends Controller
{
    public function index()
    {
        $performers = Performer::all(); // Замените на свою модель, если используете другую
        return view('map', compact('performers')); // Используйте свое представление map.blade.php
    }
}
