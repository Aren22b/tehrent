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
    <p><strong>Расстояние:</strong> {{ $order->distance }} км</p>
    <p><strong>Цена за час:</strong> {{ $order->price_per_hour }} руб.</p>
    <p><strong>Продолжительность:</strong> {{ $order->duration }} ч.</p>
    <p><strong>Форма оплаты:</strong> {{ $order->payment_form }}</p>
    <p><strong>Дополнительная информация:</strong> {{ $order->additional_info }}</p>
    <a href="{{ route('orders.edit', $order) }}">Редактировать</a>

    <!-- Форма для удаления заказа -->
    <form action="{{ route('orders.destroy', $order) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit">Удалить заказ</button>
    </form>
</body>
</html>
