{{-- resources/views/build_route.blade.php --}}

@extends('layouts.app') {{-- Предполагаем, что у тебя есть основной шаблон 'layouts.app' --}}

@section('content')
<div class="container">
    <h1>Прокладывание маршрута</h1>
    <div id="map" style="height: 400px;"></div> {{-- Контейнер для карты --}}
    <script>
        // Инициализация карты и функционал для прокладывания маршрута
        function initMap() {
            var map = L.map('map').setView([55.751244, 37.618423], 10); // Центрируем карту на Москве

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors',
                maxZoom: 18,
            }).addTo(map);

            // Функция для прокладывания маршрута
            function getRoute(startLat, startLng, endLat, endLng) {
                fetch(`/route/${startLng}/${startLat}/${endLng}/${endLat}`)
                    .then(response => response.json())
                    .then(data => {
                        // Обработка данных маршрута и отображение на карте
                        console.log(data); // Для примера, печатаем данные в консоль
                        // Здесь ты можешь добавить логику для отображения маршрута на карте
                    });
            }

            // Пример использования функции getRoute
            getRoute(55.751244, 37.618423, 55.7601, 37.6189); // Пример координат в Москве
        }

        document.addEventListener('DOMContentLoaded', initMap);
    </script>
</div>
@endsection
