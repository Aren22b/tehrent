<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Performer Map View</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <style>
        #map { height: 100vh; }
    </style>
</head>
<body>

<div id="map"></div>

<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
<script>
    var map = L.map('map').setView([59.9342802, 30.3350986], 13); // Значения центра и масштаба карты

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    // Функция для добавления маркера исполнителя на карту
    function addPerformerMarker(performer) {
        var marker = L.marker([performer.latitude, performer.longitude]).addTo(map);
        marker.bindPopup(performer.name).openPopup();
        map.setView([performer.latitude, performer.longitude], 13);
    }

    // Получение данных о местоположении исполнителя и добавление маркера на карту
    fetch('/get/performer-locations')
        .then(response => response.json())
        .then(data => {for (let pin of data) {
            addPerformerMarker(pin)
        }})
        .catch(error => console.error('Ошибка при получении данных исполнителя:', error));
</script>

</body>
</html>
