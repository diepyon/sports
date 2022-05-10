<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('location')->nullable();
            $table->string('sports')->nullable()->comment("選んだ種目");
            $table->string('email')->unique()->nullable(); 
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable(); 
            $table->string('line_user_id')->unique(); 
            $table->string('remember_token')->nullable(); 
            $table->timestamps();
            //$table->integer('chat_rooms_id')->nullable()->comment('Chat_Roomsと紐づいているID');
            $table->foreignId('chat_rooms_id')->nullable()->constrained()->onDelete('cascade')->comment('Chat_Roomsと紐づいているID');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}