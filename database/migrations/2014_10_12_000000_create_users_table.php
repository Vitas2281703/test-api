<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->string('login')->unique();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('image')->nullable();
            $table->text('about');
            $table->enum('type', ['front', 'back']);
            $table->string('github');
            $table->string('city');
            $table->boolean('is_finished')->default(false);
            $table->string('phone')->unique();
            $table->string('telegram')->nullable();
            $table->string('birthday');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
