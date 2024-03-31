<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Map View</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <style>
        #map { height: 100vh; } /* Задаем высоту карты на весь экран */
    </style>
</head>
<body>

<div id="map"></div>

<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script>
    var map = L.map('map').setView([53.505, 83.309], 13); // Вы можете установить начальное положение карты в соответствии с вашим регионом
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    // Использование переменной orders, переданной из контроллера Laravel
    var orders = @json($orders);

    // Проверка, получен ли массив orders и является ли он не пустым
    if (Array.isArray(orders) && orders.length) {
        // Используем функцию forEach для добавления каждого заказа на карту
        orders.forEach(function(order) {
            if (order.latitude && order.longitude) {
                L.marker([order.latitude, order.longitude]).addTo(map)
                    .bindPopup(order.description); // Используем описание заказа для отображения в всплывающем окне
            }
        });
    } else {
        console.log("Нет данных о заказах для отображения на карте.");
    }
</script>

</body>
</html>
