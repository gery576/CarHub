<?php

// database/migrations/2025_07_03_000001_create_cars_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarsTable extends Migration
{
    public function up()
    {
        Schema::create('cars', function (Blueprint      $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('marka');
            $table->string('modell');
            $table->year('evjarat');
            $table->integer('ar');
            $table->text('leiras');
            $table->string('kep')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cars');
    }
}

