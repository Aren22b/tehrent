<?php

use App\Http\Controllers\PerformerController;

// Добавьте этот маршрут внутрь файла routes/api.php
Route::get('performer-location', [PerformerController::class, 'getPerformerLocation']);