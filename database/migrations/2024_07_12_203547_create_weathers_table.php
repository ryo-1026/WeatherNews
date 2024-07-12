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
        Schema::create('weathers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('prefecture_id')->constrained(); //都道府県ID
            $table->string('diescription'); //天気情報
            $table->integer('precipitation_probability'); //降水確立
            $table->integer('temperature'); //気温
            $table->dateTime('datetime'); // 3時間ごとの日時
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('weathers');
    }
};
