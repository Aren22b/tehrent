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

        <!-- Поле для ввода характера работы -->
        <div>
            <label for="type_of_work">Характер работы:</label>
            <input type="text" name="type_of_work" id="type_of_work" value="{{ $order->type_of_work }}" required>
        </div>

        <!-- Поля для остальных атрибутов заказа -->
        <div>
            <label for="address">Адрес:</label>
            <input type="text" name="address" id="address" value="{{ $order->address }}" required>
        </div>

        <div>
            <label for="distance">Расстояние:</label>
            <input type="number" name="distance" id="distance" value="{{ $order->distance }}" required>
        </div>

        <div>
            <label for="price_per_hour">Цена за час:</label>
            <input type="text" name="price_per_hour" id="price_per_hour" value="{{ $order->price_per_hour }}" required>
        </div>

        <div>
            <label for="duration">Продолжительность (часы):</label>
            <input type="number" name="duration" id="duration" value="{{ $order->duration }}" required>
        </div>

        <div>
            <label for="payment_form">Форма оплаты:</label>
            <select name="payment_form" id="payment_form" required>
                <option value="cash" {{ $order->payment_form == 'cash' ? 'selected' : '' }}>Наличными</option>
                <option value="cashless" {{ $order->payment_form == 'cashless' ? 'selected' : '' }}>Безналичный расчет</option>
            </select>
        </div>

        <div>
            <label for="additional_info">Дополнительная информация:</label>
            <textarea name="additional_info" id="additional_info">{{ $order->additional_info }}</textarea>
        </div>

        <!-- Кнопка отправки формы -->
        <button type="submit">Обновить заказ</button>
    </form>
</body>
</html>
