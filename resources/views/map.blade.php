<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Performer Map View</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <style>
        #map { height: 90vh; }
        #route-info, #search-container {
            position: absolute;
            top: 10px;
            left: 10px;
            z-index: 1000;
        }
        #route-info {
            padding: 10px;
            background-color: red;
            color: white;
            display: none;
            border-radius: 5px;
        }
        #search-container {
            background-color: white;
            padding: 10px;
            border-radius: 5px;
        }
        #address-input, #search-button {
            color: black;
            padding: 5px;
            width: 200px;
            margin-bottom: 5px; /* Отступ между элементами */
            border-radius: 5px;
            border: 1px solid #cccccc;
        }
        .ui-autocomplete {
            z-index: 1050;
            max-height: 300px;
            overflow-y: auto;
            overflow-x: hidden;
            border: 1px solid #ccc;
            background-color: white;
        }
    </style>
</head>
<body>

<div id="map"></div>
<div id="route-info">
  <!-- Сюда будут вставлены данные маршрута -->
</div>
<div id="search-container"> <!-- Обертка для поискового контейнера -->
    <input type="text" id="address-input" placeholder="Введите адрес" />
    <button id="search-button">Найти адрес</button>
</div>

<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
<script>
    var map = L.map('map').setView([55.9342802, 37.3350986], 13);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    $(function() {
        $("#address-input").autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: "https://nominatim.openstreetmap.org/search",
                    dataType: "json",
                    data: {
                        q: request.term,
                        format: "json"
                    },
                    success: function(data) {
                        response($.map(data, function(item) {
                            return {
                                label: item.display_name,
                                value: item.display_name,
                                lat: item.lat,
                                lon: item.lon
                            };
                        }));
                    }
                });
            },
            minLength: 3,
            select: function(event, ui) {
                var coordinates = new L.LatLng(ui.item.lat, ui.item.lon);
                L.marker(coordinates).addTo(map).bindPopup(ui.item.label).openPopup();
                map.setView(coordinates, 18);
            }
        });
    });

    $('#search-button').click(function() {
        var address = $('#address-input').val();
        $.ajax({
            url: "https://nominatim.openstreetmap.org/search",
            dataType: "json",
            data: {
                q: address,
                format: "json"
            },
            success: function(data) {
                if (data.length > 0) {
                    var item = data[0];
                    var coordinates = new L.LatLng(item.lat, item.lon);
                    L.marker(coordinates).addTo(map).bindPopup(item.display_name).openPopup();
                    map.setView(coordinates, 18);
                } else {
                    alert('Адрес не найден');
                }
            },
            error: function() {
                alert('Ошибка при поиске адреса');
            }
        });
    });
</script>
</body>
</html>
