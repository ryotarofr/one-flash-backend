<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('subjects', function (Blueprint $table) {
            $table->id();
            $table->string('name_kanji');
            $table->string('name_kana');
            $table->string('nickname')->nullable();
            $table->string('x_account')->nullable();
            $table->string('instagram_account')->nullable();
            $table->string('email')->unique();
            $table->string('phone')->unique();
            $table->string('nearest_station');
            $table->string('self_introduction');
            $table->integer('stature');
            $table->integer('weight');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('picture_id')->nullable();
            $table->enum('transportation', ['train', 'bus', 'car']);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('picture_id')->references('id')->on('pictures');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subjects');
    }
};
