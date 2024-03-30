<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{

public function up()
{
    Schema::create('orders', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade'); // ID пользователя (исполнителя или диспетчера)
        $table->string('type_of_work'); // Характер работы
        $table->string('address'); // Адрес
        $table->unsignedBigInteger('distance'); // Расстояние до точки
        $table->decimal('price_per_hour', 8, 2); // Цена за час
        $table->unsignedInteger('duration'); // Продолжительность работы
        $table->enum('payment_form', ['cash', 'cashless']); // Форма оплаты
        $table->text('additional_info')->nullable(); // Дополнительная информация
        $table->timestamps(); // Создает поля created_at и updated_at
    });
}
}