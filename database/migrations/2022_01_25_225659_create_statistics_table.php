<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatisticsTable extends Migration
{
    public function up()
    {
        Schema::create('statistics', function (Blueprint $table) {
            $table->id();
            $table->string('starter');
            $table->string('database');
            $table->string('cache');
            $table->string('queue');
            $table->string('search');
            $table->string('cashier');
            $table->timestamps();
        });
    }
}
