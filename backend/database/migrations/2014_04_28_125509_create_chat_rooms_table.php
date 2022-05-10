<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chat_rooms', function (Blueprint $table) {
            $table->id();
            $table->string('room_name')->comment('ルームの名前');
            $table->string('location')->comment('地域');
            $table->dateTime('event_day')->comment('希望日');
            $table->integer('count_per')->comment('ルームにいる人数');
            $table->boolean('locked')->default(true)->comment('ルームが解放されているか');
            $table->foreignId('sports_id')->constrained()->onDelete('cascade')->comment('スポーツテーブルと紐づいているID');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chat_rooms');
    }
}