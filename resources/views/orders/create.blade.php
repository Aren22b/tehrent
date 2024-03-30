<!-- resources/views/orders/create.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Создать заказ</title>
</head>
<body>
    <h1>Создать новый заказ</h1>
    <form method="POST" action="{{ route('orders.store') }}">
        @csrf
        <!-- Поля формы для создания заказа -->
        <div>
            <label for="type_of_work">Характер работы:</label>
            <input type="text" name="type_of_work" id="type_of_work" required>
        </div>
        <!-- Остальные поля... -->
        <button type="submit">Создать заказ</button>
    </form>
</body>
</html>
