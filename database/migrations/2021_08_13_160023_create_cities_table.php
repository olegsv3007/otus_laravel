<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCitiesTable extends Migration
{
    public function up()
    {
        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('country_id');
            $table->float('latitude');
            $table->float('longitude');

            $table->foreign('country_id')->references('id')->on('countries');
        });
    }

    public function down()
    {
        Schema::dropIfExists('cities');
    }
}
