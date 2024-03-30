<!-- resources/views/orders/show.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Просмотр заказа</title>
</head>
<body>
    <h1>Просмотр заказа №{{ $order->id }}</h1>
    <p><strong>Характер работы:</strong> {{ $order->type_of_work }}</p>
    <p><strong>Адрес:</strong> {{ $order->address }}</p>
    <p><strong>Расстояние:</strong> {{ $order->distance }}</p>
    <!-- Остальные детали заказа... -->
    <a href="{{ route('orders.edit', $order) }}">Редактировать</a>
</body>
</html>

