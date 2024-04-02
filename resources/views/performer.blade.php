{{-- resources/views/performer.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Статус исполнителя</title>
    <meta name="csrf-token" content="{{ csrf_token() }}"> <!-- Добавлен тег для CSRF токена -->
</head>
<body>
    <h1>Статус исполнителя</h1>
    {{-- Добавляем проверку, что объект performer не null --}}
    @if(isset($performer) && $performer)
    <label>
        На линии
        {{-- Теперь безопасно используем свойство is_online, потому что знаем, что performer существует --}}
        <input type="checkbox" id="is_online" {{ $performer->is_online ? 'checked' : '' }}>
    </label>
    <script>
        document.getElementById('is_online').addEventListener('change', function() {
            if ("geolocation" in navigator) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    fetch('/set/performer-status', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({
                            is_online: document.getElementById('is_online').checked,
                            latitude: position.coords.latitude,
                            longitude: position.coords.longitude
                        })
                    })
                    .then(response => response.json())
                    .then(data => console.log(data))
                    .catch(error => console.error('Ошибка:', error));
                }, function(error) {
                    console.error('Ошибка получения местоположения:', error);
                });
            } else {
                console.error("Geolocation is not supported by this browser.");
            }
        });
    </script>
    @else
    <p>Вам нужно войти в систему как исполнитель, чтобы увидеть эту страницу.</p>
    @endif
</body>
</html>
