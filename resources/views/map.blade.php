<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Performer Map View</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <style>
        #map { height: 90vh; }
        #route-info {
            position: absolute;
            top: 10px;
            left: 10px;
            padding: 10px;
            background-color: red;
            color: white;
            display: none; /* Изначально скрыт */
            border-radius: 5px;
            z-index: 1000;
        }
    </style>
</head>
<body>

<div id="map"></div>
<div id="route-info">
  <!-- Сюда будут вставлены данные маршрута -->
</div>
<button onclick="drawRoute()">Проложить маршрут</button>

<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
<script>
    var map = L.map('map').setView([55.9342802, 37.3350986], 13);

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
            .then(response => response.json())
            .then(data => {
                console.log(data); // Проверка данных в консоли
                if (data.code === 'Ok') {
                    var coordinates = data.routes[0].geometry.coordinates;
                    var latlngs = coordinates.map(coord => [coord[1], coord[0]]);
                    var polyline = L.polyline(latlngs, {color: 'blue'}).addTo(map);
                    map.fitBounds(polyline.getBounds());

                    // Отображаем информацию о маршруте на странице
                    var distance = (data.routes[0].distance / 1000).toFixed(2); // км
                    var duration = (data.routes[0].duration / 60).toFixed(2); // мин
                    console.log(`Расстояние: ${distance} км, Время в пути: ${duration} мин`); // Дополнительная проверка
                    var routeInfoDiv = document.getElementById('route-info');
                    routeInfoDiv.innerHTML = `Расстояние: ${distance} км<br>Время в пути: ${duration} мин`;
                    routeInfoDiv.style.display = 'block'; // Убедитесь, что элемент виден
                } else {
                    console.error('Ошибка при построении маршрута:', data.message);
                }
            })
            .catch(error => {
                console.error('Ошибка при запросе маршрута:', error);
            });
    }

    map.on('dblclick', function(e) {
    geocodeLatLng(e.latlng, function(address) {
        L.popup()
            .setLatLng(e.latlng)
            .setContent(address)
            .openOn(map);
    });
});

function geocodeLatLng(latlng, callback) {
    const url = `https://nominatim.openstreetmap.org/reverse?format=json&lat=${latlng.lat}&lon=${latlng.lng}`;
    fetch(url)
        .then(response => response.json())
        .then(data => {
            if (data.address) {
                const addressParts = [];
                if (data.address.road) addressParts.push(data.address.road);
                if (data.address.house_number) addressParts.push(data.address.house_number);
                callback(addressParts.join(', '));
            } else {
                callback('Адрес не найден');
            }
        })
        .catch(error => {
            console.error('Ошибка при запросе адреса:', error);
            callback('Ошибка при запросе адреса');
        });
}


</script>

</body>
</html>