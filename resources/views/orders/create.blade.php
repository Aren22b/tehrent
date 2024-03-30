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
        <div>
            <label for="type_of_work">Характер работы:</label>
            <input type="text" name="type_of_work" id="type_of_work" required>
        </div>
        <div>
            <label for="address">Адрес:</label>
            <input type="text" name="address" id="address" required>
        </div>
        <div>
            <label for="distance">Расстояние:</label>
            <input type="number" name="distance" id="distance" required>
        </div>
        <div>
            <label for="price_per_hour">Цена за час:</label>
            <input type="number" step="0.01" name="price_per_hour" id="price_per_hour" required>
        </div>
        <div>
            <label for="duration">Продолжительность (часы):</label>
            <input type="number" name="duration" id="duration" required>
        </div>
        <div>
            <label for="payment_form">Форма оплаты:</label>
            <select name="payment_form" id="payment_form" required>
                <option value="">Выберите...</option>
                <option value="cash">Наличными</option>
                <option value="cashless">Безналичный расчет</option>
            </select>
        </div>
        <div>
            <label for="additional_info">Дополнительная информация:</label>
            <textarea name="additional_info" id="additional_info"></textarea>
        </div>
        <button type="submit">Создать заказ</button>
    </form>
</body>
</html>
