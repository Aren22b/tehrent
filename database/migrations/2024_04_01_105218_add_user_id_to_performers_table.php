<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdToPerformersTable extends Migration
{
    public function up()
    {
        Schema::table('performers', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable(); // Добавляется новый столбец
            $table->foreign('user_id')->references('id')->on('users'); // Устанавливается внешний ключ
        });
    }

    public function down()
    {
        Schema::table('performers', function (Blueprint $table) {
            $table->dropForeign(['user_id']); // Удаляется внешний ключ
            $table->dropColumn('user_id'); // Удаляется столбец
        });
    }
}
