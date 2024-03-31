<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Map View</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <style>
        #map { height: 1200px; }
    </style>
</head>
<body>

<div id="map"></div>

<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script>
    var map = L.map('map').setView([51.505, -0.09], 13);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    // Представим, что у нас есть массив orders с данными о заказах
    var orders = [
        { id: 1, lat: 51.505, lng: -0.09, description: 'Order 1 description' },
        { id: 2, lat: 51.515, lng: -0.10, description: 'Order 2 description' },
        // Добавьте сюда дополнительные заказы
    ];

    // Добавляем маркеры на карту для каждого заказа
    orders.forEach(function(order) {
        L.marker([order.lat, order.lng]).addTo(map)
            .bindPopup(order.description);
    });
</script>

</body>
</html>
