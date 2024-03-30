<!-- resources/views/orders/index.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Список заказов</title>
</head>
<body>
    <h1>Список заказов</h1>
    @forelse ($orders as $order)
        <p>{{ $order->type_of_work }} - {{ $order->address }}</p>
    @empty
        <p>Заказов пока нет.</p>
    @endforelse
</body>
</html>
