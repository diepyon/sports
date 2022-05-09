<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColmunsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('location');
            $table->integer('chat_id');
            $table->string('sports');

            $table->string('email')->unique()->nullable()->change(); // 変更
            $table->timestamp('email_verified_at')->nullable()->change();
            $table->string('password')->nullable()->change(); // 変更
            $table->string('line_user_id')->unique()->nullable(); // 追加            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('location');
            $table->dropColumn('chat_id');
            $table->dropColumn('sports');
            $table->dropColumn('line_user_id');

            $table->string('email')->unique()->nullable(false)->change(); // 変更
            $table->timestamp('email_verified_at')->nullable(false)->change();
            $table->string('password')->nullable(false)->change(); // 変更
                      
        });
    }
}
