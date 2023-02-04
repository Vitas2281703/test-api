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
            $table->string('login')->unique()->nullable();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('image')->nullable();
            $table->text('about')->nullable();
            $table->enum('type', ['front', 'back'])->nullable();
            $table->string('github')->nullable();
            $table->string('city');
            $table->boolean('is_finished')->default(false);
            $table->string('phone')->unique();
            $table->string('telegram')->nullable();
            $table->string('birthday');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('auth_token')->nullable();
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
