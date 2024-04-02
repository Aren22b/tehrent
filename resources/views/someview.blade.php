<button onclick="updateStatus()">Я на линии</button>

<script>
function updateStatus() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            fetch('/performer/status', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // Добавь этот тег в head шаблона, если его нет
                },
                body: JSON.stringify({
                    is_online: true,
                    latitude: position.coords.latitude,
                    longitude: position.coords.longitude
                })
            }).then(response => response.json())
              .then(data => console.log(data));
        });
    }
}
</script>
