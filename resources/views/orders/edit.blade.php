<!-- resources/views/orders/edit.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Редактировать заказ</title>
</head>
<body>
    <h1>Редактировать заказ №{{ $order->id }}</h1>
    <form method="POST" action="{{ route('orders.update', $order) }}">
        @csrf
        @method('PUT')
        <div>
            <label for="type_of_work">Характер работы:</label>
            <input type="text" name="type_of_work" id="type_of_work" value="{{ $order->type_of_work }}" required>
        </div>
        <!-- Остальные поля для редактирования заказа... -->
        <button type="submit">Обновить заказ</button>
    </form>
</body>
</html>

