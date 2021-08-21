<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHotelsTable extends Migration
{
    public function up()
    {
        Schema::create('hotels', function (Blueprint $table) {
            $table->id();
            $table->boolean('active')->default(0);
            $table->unsignedBigInteger('organization_id');
            $table->unsignedBigInteger('city_id');
            $table->string('name');
            $table->string('slug');
            $table->string('phone');
            $table->string('email');
            $table->float('latitude');
            $table->float('longitude');
            $table->string('address');
            $table->unsignedSmallInteger('discount')->default(0);
            $table->string('main_image');

            $table->foreign('organization_id')->references('id')->on('organizations');
            $table->foreign('city_id')->references('id')->on('cities');
        });
    }

    public function down()
    {
        Schema::dropIfExists('hotels');
    }
}
