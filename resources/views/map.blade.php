<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Performer Map View</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <style>
        #map { height: 90vh; }
    </style>
</head>
<body>

<div id="map"></div>
<!-- Вставьте этот код после <div id="map"></div> -->
<button onclick="drawRoute()">Проложить маршрут</button>

<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
<script>
    var map = L.map('map').setView([53.9342802, 83.3350986], 13);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    let startPoint, endPoint;

    map.on('click', function(e) {
        if (!startPoint) {
            startPoint = e.latlng;
            L.marker(startPoint).addTo(map).bindPopup('Точка А').openPopup();
        } else if (!endPoint) {
            endPoint = e.latlng;
            L.marker(endPoint).addTo(map).bindPopup('Точка Б').openPopup();
        } else {
            map.eachLayer(function(layer) {
                if (!(layer instanceof L.TileLayer)) {
                    map.removeLayer(layer);
                }
            });
            startPoint = e.latlng;
            L.marker(startPoint).addTo(map).bindPopup('Точка А').openPopup();
            endPoint = null;
        }
    });

    function drawRoute() {
        if (!startPoint || !endPoint) {
            alert('Необходимо установить обе точки маршрута перед его построением.');
            return;
        }
        var routeUrl = `http://localhost:5000/route/v1/driving/${startPoint.lng},${startPoint.lat};${endPoint.lng},${endPoint.lat}?overview=full&geometries=geojson`;
        console.log('Fetching route with URL:', routeUrl);
        fetch(routeUrl)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok: ' + response.statusText);
                }
                return response.json();
            })
            .then(data => {
                console.log('Route data:', data); // Добавить эту строку
                if (data.code === 'Ok') {
                    var coordinates = data.routes[0].geometry.coordinates;
                    var latlngs = coordinates.map(function(coord) {
                        return [coord[1], coord[0]];
                    });
                    var polyline = L.polyline(latlngs, {color: 'blue'}).addTo(map);
                    map.fitBounds(polyline.getBounds());
                } else {
                    console.error('Ошибка при построении маршрута:', data.message);
                }
            })
            .catch(error => console.error('Ошибка при запросе маршрута:', error));
    }

</script>

</body>
</html>
